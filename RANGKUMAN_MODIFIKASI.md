# Rangkuman & Dokumentasi Modifikasi ERM
**RSIA Aisyiyah Pekajangan**  

Dokumen ini mencatat seluruh modifikasi sistem, penambahan tabel basis data, backend, frontend, serta integrasi fitur ERM (Elektronik Rekam Medis) untuk kebutuhan operasional rumah sakit dan pemenuhan standar Akreditasi Rumah Sakit lintas Pokja.

---

## Modifikasi 1: Asesmen Awal Medis Gawat Darurat (UGD / IGD)

### 1. Deskripsi Perubahan
Pembaruan formulir **Asesmen Awal Medis Gawat Darurat (UGD/IGD)** yang mencakup:
- Penataan formulir menjadi satu kolom memanjang ke bawah (*vertical layout*).
- Penamaan "Tata Laksana" diganti menjadi **Terapi** dengan checklist kategori (*Preventif, Kuratif, Rehabilitatif, Paliatif*) serta uraian terpisah untuk *Terapi Farmakologis* dan *Terapi Non Farmakologis*.
- Panel dinamis **Rencana Tindak Lanjut** (*Rawat Jalan, Rawat Inap, Dirujuk*).
- Pilihan **Kondisi Pasien Pulang** (*Perbaikan, Menolak Rawat Inap, Meninggal Dunia*).
- Fitur **Tanda Tangan Digital Pasien/Keluarga** berbasis Canvas Touch/Stylus/Mouse.
- Integrasi menu ke modul **Rawat Inap (Ranap)**.
- Template cetak dokumen PDF format A4 standar rumah sakit.

---

### 2. Struktur Basis Data (MySQL)

#### Tabel Baru: `rsia_penilaian_medis_igd`
Tabel ekstensi yang terhubung 1-to-1 dengan tabel standar `penilaian_medis_igd`.

```sql
CREATE TABLE `rsia_penilaian_medis_igd` (
  `no_rawat` varchar(17) NOT NULL,
  `terapi_kategori` set('Preventif','Kuratif','Rehabilitatif','Paliatif') DEFAULT NULL,
  `terapi_farmakologis` text,
  `terapi_non_farmakologis` text,
  `tindak_lanjut` enum('Rawat Jalan','Rawat Inap','Dirujuk') DEFAULT NULL,
  `kontrol_ke` varchar(100) DEFAULT NULL,
  `ranap_indikasi` varchar(255) DEFAULT NULL,
  `ranap_dpjp` varchar(20) DEFAULT NULL,
  `ranap_smf` varchar(50) DEFAULT NULL,
  `ranap_ruang` varchar(50) DEFAULT NULL,
  `rujuk_tujuan` enum('RS','Puskesmas') DEFAULT NULL,
  `rujuk_nama_faskes` varchar(100) DEFAULT NULL,
  `rujuk_alasan` set('Kamar Penuh','Perlu Fasilitas dan SDM','Permintaan Pasien / Keluarga') DEFAULT NULL,
  `rujuk_transport` enum('Ambulans','Kendaraan Pribadi') DEFAULT NULL,
  `kondisi_pulang` enum('Perbaikan','Menolak Rawat Inap','Meninggal Dunia') DEFAULT NULL,
  `tgl_meninggal` date DEFAULT NULL,
  `jam_meninggal` time DEFAULT NULL,
  `selesai_layanan_tgl` date DEFAULT NULL,
  `selesai_layanan_jam` time DEFAULT NULL,
  `nama_keluarga_ttd` varchar(100) DEFAULT NULL,
  `ttd_pasien` text,
  PRIMARY KEY (`no_rawat`),
  CONSTRAINT `fk_rsia_asmed_igd_norawat` FOREIGN KEY (`no_rawat`) 
    REFERENCES `penilaian_medis_igd` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/RsiaPenilaianMedisIgd.php` | Model Eloquent tabel `rsia_penilaian_medis_igd` beserta relasi ke dokter DPJP. |
| `server.php` | Router script development server bawaan Laravel untuk menjalankan `php artisan serve`. |
| `public/index.php` | Entry point utama aplikasi web Laravel. |
| `RANGKUMAN_MODIFIKASI.md` | Dokumen dokumentasi teknis ini. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/AsesmenMedisIgd.php` | Menambahkan relasi `rsiaAsmed()` dan `rsiaPenilaianMedisIgd()`. |
| `app/Models/RegPeriksa.php` | Menambahkan relasi `rsiaAsmedIgd()`. |
| `app/Models/AsesmenMedisIgdController.php` | 1. Method `get()` me-load data relasi `rsiaAsmed.dpjp`.<br>2. Method `create()` & `edit()` menyimpan data gabungan secara transaksional.<br>3. Sinkronisasi format teks otomatis ke kolom `tata` agar tetap terbaca dari SIMRS Khanza Java.<br>4. Method `print()` untuk generate tampilan cetak PDF format A4. |
| `routes/web.php` | Menghubungkan route `/asesmen/medis/ugd/print` ke `[AsesmenMedisIgdController::class, 'print']`. |
| `app/Providers/RouteServiceProvider.php` | Mendaftarkan route prefix `/erm` agar URL web dan AJAX request tidak menghasilkan error 404. |
| `resources/views/content/ugd/modal/asmed.blade.php` | 1. Penataan form ke format memanjang ke bawah (*vertical flow*).<br>2. Kategori Terapi & textarea luas untuk Terapi Farmakologis & Non Farmakologis.<br>3. Panel dinamis Rencana Tindak Lanjut & Kondisi Pasien Pulang.<br>4. Fitur Tanda Tangan Digital Pasien/Keluarga berbasis Canvas.<br>5. Perbaikan logika Triase ATS (mencegah centang otomatis tidak konsisten).<br>6. Perbaikan CSS textarea agar tidak terbatas pada tinggi 28px. |
| `resources/views/content/ranap/ranap.blade.php` | Menambahkan opsi menu **"Asesmen Medis IGD"** pada dropdown tindakan pasien di Rawat Inap. |
| `resources/views/content/print/asmed_igd.blade.php` | Template cetak PDF resmi format A4 (Kop, TTV, Terapi, Tindak Lanjut, TTD Pasien & QR Code Dokter). |
| `resources/views/index.blade.php` & `layout/head.blade.php` | Mengubah hardcode path logo dan CSS menggunakan helper standar Laravel `asset()`. |

---

### 4. Alur Penggunaan & Pengujian

1. **Akses Menu UGD**:
   - Buka `http://localhost:8000/ugd` (atau `/erm/ugd`).
   - Pilih salah satu pasien &rarr; klik menu **Asesmen Medis UGD**.
   - Isi formulir asesmen medis dan bubuhkan tanda tangan pasien.
   - Klik **Simpan Asesmen**.
2. **Cetak Dokumen PDF**:
   - Di dalam modal asesmen, klik tombol **Cetak Asesmen**.
3. **Akses dari Rawat Inap**:
   - Buka `http://localhost:8000/ranap` (atau `/erm/ranap`).
   - Klik tombol menu tindakan pasien &rarr; pilih **Asesmen Medis IGD**.
