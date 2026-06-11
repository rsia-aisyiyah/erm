# 📋 Dokumentasi Modul: Hasil Kritis Pasien

> **Sistem Informasi Rumah Sakit — Modul Hasil Kritis**
> Versi: 1.0 | Terakhir diperbarui: Juni 2026

---

## 1. Gambaran Umum

Modul **Hasil Kritis** adalah fitur untuk mengelola dan memantau nilai/temuan kritis dari pemeriksaan laboratorium atau radiologi pasien. Setiap hasil kritis wajib dilaporkan dan diverifikasi oleh tiga pihak secara berantai sebelum dianggap tuntas.

**Alur Verifikasi:**
```
Analis Lab/Radiologi (Input)
        ↓
Dokter PJ Lab/Radiologi (Konfirmasi)
        ↓
Petugas Ruangan (Konfirmasi)
        ↓
Dokter DPJP (Konfirmasi)
```

---

## 2. Struktur File

| File | Tipe | Deskripsi |
|---|---|---|
| `modalHasilKritis.blade.php` | View (Blade) | Modal form input & tabel data hasil kritis per pasien |
| `modalTabelHasilKritis.blade.php` | View (Blade) | Panel monitoring hasil kritis per petugas login |
| `RsiaHasilKritisController.php` | Controller | Menangani CRUD dan verifikasi |
| `HasilKritisRequest.php` | Form Request | Validasi input data |
| `RsiaHasilKritis.php` | Model | Eloquent model tabel `rsia_hasil_kritis` |
| `VerifikasiHasilKritis.php` | Service | Logika verifikasi & otorisasi peran |
| `HasilKritisFetchService.php` | Service | Pengambilan data hasil kritis per petugas |

---

## 3. Database

### Tabel: `rsia_hasil_kritis`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT (PK, AI) | Primary key |
| `no_rawat` | VARCHAR(17) | Nomor rawat pasien |
| `hasil` | TEXT | Isi hasil/temuan kritis |
| `petugas` | VARCHAR(20) | NIP analis lab/radiologi |
| `tgl` | DATETIME | Tanggal & jam input |
| `dokter_pj` | VARCHAR(20) | Kode dokter PJ Lab/Radiologi |
| `tgl_drpj` | DATETIME | Waktu verifikasi dokter PJ |
| `petugas_ruang` | VARCHAR(20) | NIP petugas ruangan |
| `tgl_ruang` | DATETIME | Waktu verifikasi petugas ruangan |
| `dokter` | VARCHAR(20) | Kode dokter DPJP |
| `tgl_dokter` | DATETIME | Waktu verifikasi dokter DPJP |

> Kolom `tgl_*` bernilai `NULL` berarti **belum diverifikasi**.

---

## 4. Relasi Model (`RsiaHasilKritis`)

```php
regPeriksa()   → belongsTo(RegPeriksa)   // via no_rawat
petugas()      → belongsTo(Petugas)      // via petugas (nip)
petugasRuang() → belongsTo(Petugas)      // via petugas_ruang (nip)
dokter()       → belongsTo(Dokter)       // via dokter (kd_dokter)
dokterPj()     → belongsTo(Dokter)       // via dokter_pj (kd_dokter)
kamar()        → hasOneThrough(Kamar via KamarInap) + join bangsal
```

---

## 5. API Endpoint

### 5.1 GET — Ambil Satu Data

```
GET /hasil-kritis/{id}
```

**Response:**
```json
{
  "id": 1,
  "no_rawat": "...",
  "hasil": "...",
  "petugas": { "nip": "...", "nama": "..." },
  "petugas_ruang": { ... },
  "dokter": { "kd_dokter": "...", "nm_dokter": "..." },
  "dokter_pj": { ... },
  "tgl": "2026-06-05 08:00:00",
  "tgl_ruang": null,
  "tgl_dokter": null,
  "tgl_drpj": null
}
```

---

### 5.2 GET — Daftar per No. Rawat (DataTables)

```
GET /hasil-kritis?no_rawat={no_rawat}
```

Digunakan oleh `drawHasilKritis()` untuk merender tabel di dalam modal pasien.

---

### 5.3 GET — Daftar per Petugas Login

```
GET /hasil-kritis/petugas?nip={nip}&status={status}&bulan={YYYY-MM}
```

| Parameter | Nilai | Keterangan |
|---|---|---|
| `nip` | string | NIP/NIK petugas yang login |
| `status` | `belum` / `sudah` / `semua` | Filter status verifikasi |
| `bulan` | `YYYY-MM` | Filter bulan |

---

### 5.4 POST — Simpan / Update Data

```
POST /hasil-kritis
```

**Body (Form Data):**

| Field | Required | Keterangan |
|---|---|---|
| `no_rawat` | ✅ | Nomor rawat pasien |
| `hasil` | ✅ | Teks hasil/temuan kritis |
| `petugas` | ✅ | NIP analis |
| `tgl` | ❌ | Format `d-m-Y H:i:s` (auto-convert ke `Y-m-d H:i:s`) |
| `petugas_ruang` | ✅ | NIP petugas ruangan |
| `dokter` | ✅ | Kode dokter DPJP |
| `dokter_pj` | ✅ | Kode dokter PJ Lab/Rad |
| `id` | ❌ | Jika diisi, akan melakukan **update** |

> Jika `id` dikirim dan data ditemukan di DB, otomatis beralih ke mode **update**.
> Saat update, jika `dokter`, `petugas_ruang`, atau `dokter_pj` berubah, kolom `tgl_*` terkait di-reset ke `NULL`.

---

### 5.5 POST — Hapus Data

```
POST /hasil-kritis/delete/{id}
```

---

### 5.6 POST — Verifikasi

```
POST /hasil-kritis/verifikasi/{id}
```

**Body:**

| Field | Required | Keterangan |
|---|---|---|
| `password` | ✅ | Password user yang login |
| `role` | ✅ | Salah satu dari: `dokter`, `petugas_ruang`, `dokter_pj` |

**Response Sukses:**
```json
{
  "message": "Verifikasi berhasil",
  "new_count": 3
}
```

**Response Gagal:**
```json
{
  "message": "Password salah"   // 422
  "message": "Anda bukan dokter terkait"   // 403
}
```

---

## 6. Logika Verifikasi (`VerifikasiHasilKritis` Service)

Service ini memastikan bahwa hanya pihak yang **terdaftar** pada data hasil kritis yang dapat memverifikasi, dan setiap role hanya dapat memverifikasi bagiannya masing-masing.

```
verifyAndExecute(id, password, role)
    ├── verifyUserCredentials(password)
    │       ├── Cek user exist via AuthVerificationService
    │       └── Cek password via AuthVerificationService
    └── authorizeAndFieldsUpdate(hasilKritis, petugas, role)
            ├── role = 'petugas_ruang' → cek nip, update tgl_ruang
            ├── role = 'dokter'        → cek nip, update tgl_dokter
            └── role = 'dokter_pj'    → cek nip, update tgl_drpj
```

Jika otorisasi gagal (NIP tidak sesuai), dilempar `HttpException 403`.
Jika password salah, dilempar `HttpException 422`.

---

## 7. Frontend — Fungsi JavaScript Utama

### Modal Input (`modalHasilKritis`)

| Fungsi | Deskripsi |
|---|---|
| `hasilKritis(no_rawat)` | Membuka modal & memuat data pasien |
| `setInfoPasienKritis(no_rawat)` | Mengisi field info pasien dari API |
| `simpanHasilKritis()` | Submit form simpan/update via AJAX POST |
| `drawHasilKritis(no_rawat)` | Render tabel DataTables hasil kritis |
| `hapusHasilKritis(id)` | Konfirmasi & hapus data |
| `setHasilKritis(id)` | Isi form untuk mode edit |
| `verifikasiHasilKritis(id, role)` | Prompt password → POST verifikasi |

### Panel Monitoring (`modalTabelHasilKritis`)

| Fungsi | Deskripsi |
|---|---|
| `showTabelHasilKritis()` | Buka panel monitoring & load data |
| `getHasilKritis(bulan, status)` | Fetch & render kartu hasil kritis |
| `verifikasiDataHasilKritis(id, role)` | Verifikasi dari panel monitoring |

---

## 8. Logika Penentuan Role (Frontend Panel Monitoring)

Saat merender kartu di panel monitoring, sistem menentukan role user yang login secara otomatis:

```
Jika loginNik == dokter_pj.kd_dokter
    → role = 'dokter_pj' (Dokter Lab/Rad)
    → Jika PJ sudah verifikasi & loginNik juga sebagai DPJP & DPJP belum verifikasi
        → beralih ke role = 'dokter' (DPJP)
Jika loginNik == dokter.kd_dokter
    → role = 'dokter' (Dokter DPJP)
Selain itu
    → role = 'petugas_ruang'
```

Tampilan kartu disesuaikan:
- **Border merah + shadow** → belum verifikasi
- **Border hijau** → sudah verifikasi
- **Badge "BELUM ANDA KONFIRMASI"** → tombol aktif berwarna merah
- **Badge "Anda Sudah Verifikasi"** → tombol disabled berwarna hijau

---

## 9. Validasi Input (`HasilKritisRequest`)

| Field | Aturan |
|---|---|
| `no_rawat` | required, string, max:17 |
| `hasil` | required, string, max:1000 |
| `petugas` | required, string, max:20 |
| `petugas_ruang` | required, string, max:20 |
| `dokter` | required, string, max:20 |
| `dokter_pj` | required, string, max:20 |
| `tgl` | nullable, auto-parse `d-m-Y H:i:s` → `Y-m-d H:i:s` |
| `tgl_ruang` | nullable |
| `tgl_dokter` | nullable |

---

## 10. Catatan Pengembangan

- Setiap aksi tulis (create/update/delete) dicatat via `TrackerSqlController` untuk audit log.
- Notifikasi badge hasil kritis di navbar diperbarui otomatis setelah verifikasi via `NotificationService::getHasilKritisCount()`.
- Filter panel monitoring menggunakan `HasilKritisFetchService` untuk memisahkan logika query dari controller.
- `$guarded = []` pada model berarti semua kolom mass-assignable — pastikan validasi selalu melalui `HasilKritisRequest`.