# Dokumentasi Sistem Verifikasi & Unduh Dokumen Tertandatangan (RSIA)

## 1. Latar Belakang

Sistem menangani banyak jenis dokumen yang ditandatangani secara digital: General Consent, Informed Consent, Persetujuan Operasi, Persetujuan Anestesi, Surat Kelahiran, Surat Kematian, Resume Medis, SEP BPJS, Hasil Lab, Hasil Radiologi, dan Hasil EKG.

Karena tabel-tabel dokumen ini **sudah terlanjur dibuat terpisah per jenis** (misal `rsia_persetujuan_umum`), arsitektur di dokumen ini dirancang supaya:

- Tabel tetap terpisah (tidak perlu migrasi data besar-besaran)
- Tapi **service dan controller tetap satu**, tidak ada percabangan `if/switch` per jenis dokumen yang terus tumbuh setiap ada dokumen baru

Pola yang dipakai: **Registry + Adapter (Resolver) Pattern**.

---

## 2. Struktur Direktori

```
app/
  Services/
    Dokumen/
      Contracts/
        DokumenResolverInterface.php
      Resolvers/
        BaseColumnResolver.php          (abstract, untuk tabel berkolom seragam)
        PersetujuanUmumResolver.php
        HasilLabResolver.php            (contoh tabel legacy, kolom tidak seragam)
      DokumenResolverRegistry.php
      AutentikasiUnduhDokumenService.php
      PenandatangananDokumenService.php
  Http/
    Controllers/
      VerifikasiDokumenController.php
      UnduhDokumenController.php
    Requests/
      VerifikasiUnduhDokumenRequest.php
config/
  dokumen.php
resources/
  views/
    dokumen/
      form_unduh.blade.php
      modal_authentication.blade.php
    content/
      verify_dokumen.blade.php
    verify/
      invalid.blade.php
```

---

## 3. Konsep Inti: Registry + Resolver

### 3.1 Kenapa bukan satu tabel besar?

Karena tabel sudah terlanjur terpisah. Alternatifnya (satu tabel `dokumen_tertandatangan` generik dengan `source_table`/`metadata`) tetap lebih ideal untuk pengembangan baru, tapi butuh migrasi data — tidak dipakai di sini demi kompatibilitas dengan data lama.

### 3.2 Cara kerja

Setiap jenis dokumen punya satu **Resolver** — kelas kecil yang tahu detail tabelnya sendiri (nama tabel, nama kolom, join tambahan). Semua resolver **wajib** mengimplementasikan `DokumenResolverInterface`, sehingga service dan controller di atasnya tidak perlu tahu perbedaan struktur tabel apa pun.

```php
interface DokumenResolverInterface
{
    public function table(): string;
    public function findByUuid(string $uuid): ?array;   // data ternormalisasi
    public function existsUuid(string $uuid): bool;      // cek cepat, tahu nama kolom uuid sendiri
    public function label(): string;                     // nama tampilan, misal "Persetujuan Umum"
    public function viewTemplate(): string;               // partial view konten
    public function nomorPrefix(): string;                 // prefix nomor dokumen, misal "GC"
}
```

**Dua tipe implementasi:**

| Tipe | Kapan dipakai | Contoh |
|---|---|---|
| `extends BaseColumnResolver` | Tabel punya kolom seragam: `uuid`, `no_rawat`, `nip`, `file`, `hash`, `signed_at` | `PersetujuanUmumResolver` |
| `implements DokumenResolverInterface` langsung | Tabel legacy dengan nama kolom berbeda (misal `uuid_dokumen`, `kode_pendaftaran`, `tgl_ttd`) | `HasilLabResolver` |

### 3.3 Registry

`DokumenResolverRegistry` membaca `config/dokumen.php` dan meng-instansiasi resolver sesuai kode jenis dokumen:

```php
// config/dokumen.php
return [
    'resolvers' => [
        'GENERAL_CONSENT' => \App\Services\Dokumen\Resolvers\PersetujuanUmumResolver::class,
        'LAB_RESULT'      => \App\Services\Dokumen\Resolvers\HasilLabResolver::class,
        // tambah 1 baris per jenis dokumen baru, tanpa ubah service/controller
    ],
];
```

Menambah jenis dokumen baru = **1 resolver baru + 1 baris config**. Tidak menyentuh service atau controller.

### 3.4 Menemukan jenis dokumen dari uuid saja

URL verifikasi/unduh hanya berisi `{uuid}`, tanpa tahu jenis dokumennya. Registry mencari lewat `existsUuid()` ke tiap resolver terdaftar (bukan asumsi nama kolom seragam):

```php
public function findKodeByUuid(string $uuid): ?string
{
    foreach ($this->all() as $kode => $resolver) {
        if ($resolver->existsUuid($uuid)) {
            return $kode;
        }
    }
    return null;
}
```

> **Catatan skala**: kalau jumlah tabel sudah puluhan dan traffic tinggi, loop ini bisa diganti tabel index tipis (`uuid`, `kode_jenis`) yang diisi otomatis saat dokumen dibuat, supaya pencarian cukup 1 query.

---

## 4. Integritas File: Kolom `hash`

### 4.1 Apa yang di-hash

`hash` (SHA-256) dihitung dari **binary file PDF final**, bukan dari data mentah (HTML, JSON, field-field individual).

```
generate PDF → hash(binary PDF) → simpan file + hash
```

Urutan ini wajib: hash dihitung **setelah** PDF selesai di-generate, karena proses generate (font rendering, metadata, timestamp) bisa menghasilkan binary berbeda walau data sumbernya sama.

### 4.2 Verifikasi integritas

```php
$fileContent = Storage::disk('local')->get($dokumen['file']);
$hashValid = hash_equals($dokumen['hash'], hash('sha256', $fileContent ?? ''));
```

`hash_equals()` dipakai (bukan `===`) untuk perbandingan constant-time, mencegah timing attack.

### 4.3 Revisi dokumen

Kalau dokumen di-generate ulang (misal cetak ulang/revisi), itu **wajib** jadi record baru dengan `uuid` dan `hash` baru — bukan update file lama dengan hash lama.

---

## 5. Otentikasi Sebelum Unduh: No. RM + Tanggal Lahir

### 5.1 Kenapa perlu, dan bedanya dengan hash

| Mekanisme | Melindungi apa |
|---|---|
| Kolom `hash` | Integritas file (tidak diubah sejak ditandatangani) |
| No. RM + tanggal lahir | Identitas pengunduh (memastikan yang minta file memang berhak) |

Keduanya **tidak saling menggantikan**.

### 5.2 Risiko brute-force

No. RM + tanggal lahir punya entropi rendah (No. RM sering berurutan, tanggal lahir hanya ±36.500 kemungkinan). Karena itu **wajib** ada rate limiting per `uuid + IP`:

```php
private const MAX_ATTEMPTS = 5;
private const LOCKOUT_SECONDS = 900; // 15 menit

RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS);
RateLimiter::hit($key, self::LOCKOUT_SECONDS);
```

Data pasien asli diambil dari `no_rawat` milik dokumen (bukan dari input user), lalu dibandingkan pakai `hash_equals()`.

### 5.3 Pesan error tidak boleh spesifik

Response gagal **tidak** membedakan "dokumen tidak ditemukan" vs "identitas tidak cocok" ke user — supaya tidak membantu percobaan enumerasi No. RM yang valid.

---

## 6. Alur Unduh Dokumen (End-to-End)

```
1. User buka halaman verifikasi dokumen (GET /verify/{uuid})
   → tampil info dokumen + tombol "Unduh" yang buka modal otentikasi

2. User isi No. RM + Tanggal Lahir di modal
   → jQuery $.ajax POST ke /dokumen/verifikasi-unduh

3. Server:
   a. Cari kode jenis dokumen dari uuid (registry)
   b. Cek rate limit
   c. Bandingkan No. RM + tanggal lahir dengan data asli pasien
   d. Kalau gagal → JSON {ok:false, pesan:"..."}, modal tampilkan #verifyError
   e. Kalau berhasil → generate SIGNED URL (berlaku 5 menit) ke endpoint unduh,
      balas JSON {ok:true, url:"..."}

4. JS redirect browser ke signed URL
   → GET /dokumen/{uuid}/unduh-file?signature=...&expires=...

5. Middleware `signed` Laravel otomatis menolak (403) kalau signature
   tidak valid/kadaluarsa — endpoint ini TIDAK bisa diakses langsung
   tanpa lewat langkah 3 dulu.

6. Controller stream file dengan Storage::download(), nama file:
   "{PREFIX}-RSIA-{TAHUN}-{NOMOR_URUT}.pdf" (misal GC-RSIA-2026-000012.pdf)
```

### Kenapa signed URL, bukan session flag?

Signed URL bersifat stateless (tidak butuh session), cocok untuk link yang mungkin dibuka di tab baru, dan otomatis kadaluarsa tanpa perlu cleanup manual.

---

## 7. Penamaan File Unduhan

### 7.1 Yang WAJIB dihindari

Nama file **tidak boleh** berisi data identitas pasien:

- ❌ `Budi_Santoso_1234567.pdf` — PHI di nama file bisa tersimpan di log/riwayat email pihak ketiga saat di-forward
- ❌ `RM-1234567-19900101.pdf` — ini persis kombinasi No. RM + tanggal lahir, kredensial otentikasi yang dipakai. Kalau file ini di-forward, penerima jadi tahu "kunci" untuk mengunduh dokumen lain milik pasien yang sama.

### 7.2 Rekomendasi

```php
private function namaFileUnduhan(string $prefix, array $dokumen): string
{
    $tahun = date('Y', strtotime($dokumen['created_at']));
    $nomorUrut = str_pad((string) $dokumen['id'], 6, '0', STR_PAD_LEFT);
    return "{$prefix}-RSIA-{$tahun}-{$nomorUrut}.pdf";
}
```

Hasil: `GC-RSIA-2026-000012.pdf` — deskriptif, tanpa PHI, aman untuk diforward.

### 7.3 Soal uuid sebagai nama file

Uuid **tidak berbahaya** dari sisi kontrol akses (akses dijaga signed URL + otentikasi, bukan oleh nama file), tapi kurang ideal karena tidak informatif buat pasien dan uuid yang sama dipakai di URL verifikasi publik (`/verify/{uuid}`) — jadi jangan dianggap sebagai rahasia tambahan.

---

## 8. Ringkasan Keputusan Desain

| Keputusan | Alasan |
|---|---|
| Tabel tetap terpisah per jenis dokumen | Menghindari migrasi data besar di sistem yang sudah berjalan |
| Registry + Resolver pattern | Service/controller tetap satu tanpa percabangan per jenis |
| `existsUuid()` per resolver, bukan asumsi kolom seragam | Kompatibel dengan tabel legacy yang skema kolomnya beda-beda |
| Hash dihitung dari binary PDF final | Sinkron dengan file yang benar-benar akan diunduh |
| Otentikasi No. RM + tanggal lahir terpisah dari hash | Hash = integritas file, otentikasi = identitas pengunduh |
| Rate limiting per uuid+IP | Entropi No. RM + tanggal lahir rendah, rawan brute-force |
| Pesan error generik | Mencegah enumerasi No. RM yang valid |
| Signed URL 5 menit untuk endpoint unduh aktual | Stateless, otomatis kadaluarsa, tidak butuh session |
| Nama file tanpa PHI/kredensial | Mencegah kebocoran data saat file di-forward pasien |

---

## 9. Checklist Implementasi

- [ ] Buat folder `app/Services/Dokumen/{Contracts,Resolvers}` sesuai struktur di Bab 2
- [ ] Daftarkan tiap tabel dokumen yang sudah ada sebagai resolver baru
- [ ] Isi `config/dokumen.php` dengan seluruh kode jenis dokumen
- [ ] Pastikan disk storage yang dipakai adalah `local`, **bukan** `public`
- [ ] Jalankan `composer dump-autoload` setelah menambah class baru
- [ ] Pasang middleware `throttle` di route verifikasi dan `signed` di route unduh file
- [ ] Uji rate limiting (5x percobaan salah → terkunci 15 menit)
- [ ] Uji signed URL kadaluarsa setelah 5 menit
- [ ] Review ulang: pastikan tidak ada nama pasien/No. RM/tanggal lahir di nama file unduhan