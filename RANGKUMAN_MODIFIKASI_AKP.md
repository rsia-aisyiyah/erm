# Rangkuman Modifikasi: Asesmen Awal Medis IGD (Pokja Akreditasi Bab AKP)
**RSIA Aisyiyah Pekajangan**  
*Tanggal: 10 Agustus 2026*

---

## 1. Latar Belakang & Kebutuhan
Pembaruan formulir **Asesmen Awal Medis Gawat Darurat (UGD/IGD)** disesuaikan dengan instrumen Akreditasi Rumah Sakit pada **Pokja AKP (Akses dan Keberlanjutan Pelayanan)**, yang mencakup penataan formulir memanjang ke bawah, uraian kategori terapi, rencana tindak lanjut terstruktur, kondisi pasien pulang, serta tanda tangan digital pasien/keluarga.

---

## 2. Struktur Basis Data (MySQL)

### Tabel Baru: `rsia_penilaian_medis_igd`
Dibuat sebagai tabel relasi 1-to-1 (*ekstensi*) dengan tabel bawaan SIMKES Khanza `penilaian_medis_igd`.

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

## 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/RsiaPenilaianMedisIgd.php` | Model Eloquent tabel `rsia_penilaian_medis_igd` beserta relasi ke dokter DPJP. |
| `server.php` | Router script development server bawaan Laravel untuk menjalankan `php artisan serve`. |
| `public/index.php` | Entry point utama aplikasi web Laravel. |
| `RANGKUMAN_MODIFIKASI_AKP.md` | Dokumen dokumentasi teknis ini. |

---

### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/AsesmenMedisIgd.php` | Menambahkan relasi `rsiaAsmed()` dan `rsiaPenilaianMedisIgd()`. |
| `app/Models/RegPeriksa.php` | Menambahkan relasi `rsiaAsmedIgd()`. |
| `app/Models/AsesmenMedisIgdController.php` | 1. Method `get()` me-load data relasi `rsiaAsmed.dpjp`.<br>2. Method `create()` & `edit()` menyimpan data gabungan secara transaksional.<br>3. Sinkronisasi format teks otomatis ke kolom `tata` agar tetap terbaca dari SIMRS Khanza Java.<br>4. Method `print()` untuk generate tampilan cetak PDF format A4. |
| `routes/web.php` | Menghubungkan route `/asesmen/medis/ugd/print` ke `[AsesmenMedisIgdController::class, 'print']`. |
| `app/Providers/RouteServiceProvider.php` | Mendaftarkan route prefix `/erm` agar URL web dan 290+ AJAX request tidak menghasilkan error 404. |
| `resources/views/content/ugd/modal/asmed.blade.php` | 1. Penataan form ke format memanjang ke bawah (*vertical flow*).<br>2. Mengganti nama "Tata Laksana" menjadi **Terapi** dengan checklist (*Preventif, Kuratif, Rehabilitatif, Paliatif*) dan 2 textarea luas (*Terapi Farmakologis* & *Terapi Non Farmakologis*).<br>3. Panel dinamis **Rencana Tindak Lanjut** (*Rawat Jalan, Rawat Inap, Dirujuk*).<br>4. Pilihan **Kondisi Pasien Pulang** (*Perbaikan, Menolak Rawat Inap, Meninggal Dunia*).<br>5. Fitur **Tanda Tangan Digital Pasien/Keluarga** berbasis Canvas Touch/Stylus/Mouse.<br>6. Perbaikan logika Triase ATS (menghindari centang otomatis yang tidak konsisten).<br>7. Perbaikan CSS textarea agar tidak terbatas pada tinggi 28px. |
| `resources/views/content/ranap/ranap.blade.php` | Menambahkan opsi menu **"Asesmen Medis IGD"** pada setiap pasien di tabel Rawat Inap. |
| `resources/views/content/print/asmed_igd.blade.php` | Template cetak PDF resmi format A4 sesuai lampiran Bab AKP standar akreditasi RS. |
| `resources/views/index.blade.php` & `layout/head.blade.php` | Mengubah hardcode path logo dan CSS menggunakan helper standar Laravel `asset()`. |

---

## 4. Cara Penggunaan & Pengujian

1. **Akses Menu UGD**:
   - Buka `http://localhost:8000/ugd` (atau `/erm/ugd`).
   - Pilih salah satu pasien &rarr; klik menu **Asesmen Medis UGD**.
   - Isi data anamnesis, pemeriksaan, terapi farmakologis/non-farmakologis, tindak lanjut, dan bubuhkan tanda tangan pasien.
   - Klik **Simpan Asesmen**.
2. **Cetak Dokumen PDF**:
   - Di dalam modal asesmen, klik tombol **Cetak Asesmen (AKP)**.
3. **Akses dari Rawat Inap**:
   - Buka `http://localhost:8000/ranap` (atau `/erm/ranap`).
   - Klik tombol menu tindakan pasien &rarr; pilih **Asesmen Medis IGD**.

---

## 5. Status Git Repository
* **Commit Terakhir**: `3070740a`
* **Message**: `feat(ugd): implementasi asesmen awal medis igd akreditasi AKP, digital signature, dan integrasi ranap`
* **Status**: Tersimpan di Git lokal komputer.
