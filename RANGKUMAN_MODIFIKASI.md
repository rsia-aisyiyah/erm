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
- Fitur **Tanda Tangan Digital Pasien/Keluarga** berbasis Canvas Touch/Stylus/Mouse dengan penyimpanan file fisik PNG di storage disk (`storage/app/public/signatures/penilaian_medis_igd/`) untuk menjaga ukuran database tetap ringan dan performa query maksimal.
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

---

## Modifikasi 2: Paket Edukasi Pasien & Keluarga Rawat Inap (RM 20, RM 23 & RM 24)

### 1. Deskripsi Perubahan
Pembaruan menyeluruh pada modul **Edukasi Pasien & Keluarga Rawat Inap** untuk mengakomodasi 1 paket lengkap standar Akreditasi Rumah Sakit (Pokja KE / HPK):
- **Form RM 20 (Assesmen Kebutuhan dan Perencanaan Pendidikan Pasien & Keluarga)**:
  - **Bagian A (Pengkajian Kebutuhan)**: Agama & keyakinan, bahasa sehari-hari (Indo/Daerah/Inggris/Lainnya - Aktif/Pasif), kebutuhan penerjemah, bahasa isyarat, cara belajar yang disukai, tingkat pendidikan, kemampuan membaca, hambatan emosi, kesediaan menerima info, keterbatasan fisik/kognitif, dan 11 poin kebutuhan pendidikan.
  - **Bagian B (Perencanaan Edukasi)**: Rencana individu/kolaboratif, tabel terstruktur 10 topik kebutuhan edukasi lengkap dengan PPA penanggung jawab, sasaran (P/K/P&K), cara edukasi (D/C/Demo/S/O/PL), dan metode evaluasi pemahaman.
  - **Fitur Cerdas**: Tombol *"Set Standar Normal"* untuk auto-fill cepat dan efisien.
- **Form RM 23 (Edukasi Multidisiplin PPA)**:
  - Pembagian profesi: **DPJP (Dokter Spesialis)**, **Farmasi**, **Perawat / Bidan**, **Nutrisionis (Gizi)**, dan **Manajemen Nyeri**.
  - Pilihan checklist poin-poin materi standar akreditasi + opsi *"Lain-lain (Catatan Tambahan)"*.
- **Form RM 24 (Edukasi Pasien Terbuka)**:
  - Form edukasi dengan kolom materi berupa teks bebas (*free text*) untuk mencatat topik edukasi tindakan/penyakit spesifik.
- **Parameter Bersama**:
  - Tanggal & waktu edukasi beserta durasi (misal: "10 Menit").
  - Pilihan **Metode Pembelajaran** (*Multiple Check*: Diskusi / Wawancara, Simulasi, Demonstrasi, Ceramah, Observasi, Praktek Langsung).
  - **Hambatan Edukasi & Intervensi** (*Multiple Check* dengan interaktivitas cerdas: opsi "Tidak Ada" otomatis eksklusif, serta opsi "Lain-lain" otomatis membuka input teks keterangan).
  - **Tanda Tangan Digital Pasien/Keluarga** berbasis Canvas Touch/Stylus/Mouse dengan penyimpanan file fisik PNG di `storage/app/public/signatures/catatan_edukasi_pasien/`.
  - **Barcode QR Code Edukator** otomatis ter-generate berdasarkan akun login petugas/dokter.
- **Empat Opsi Cetak PDF Resmi Termasuk Bundling Terpadu**:
  - Cetak Form **RM 20** (*Assesmen Kebutuhan dan Perencanaan Pendidikan Pasien dan Keluarga Rawat Inap*).
  - Cetak Form **RM 23** (*Catatan Pelaksanaan Pendidikan Pasien dan Keluarga dari Multi Disiplin*).
  - Cetak Form **RM 24** (*Catatan Pelaksanaan Edukasi Kepada Pasien*).
  - **Cetak Bundling (Paket Edukasi Pasien)**: Menggabungkan dokumen RM 20, RM 23, dan RM 24 ke dalam 1 file PDF berhalaman jamak secara cerdas dan kondisional (misal: jika RM 23 kosong, maka otomatis mencetak RM 20 & RM 24 saja).
- **Kontrol Cerdas & Tooltip Interaktif**:
  - Seluruh tombol cetak (*RM 20, RM 23, RM 24, & Bundling*) otomatis **Nonaktif (*Disabled*)** jika belum ada data terkait yang disimpan.
  - Efek **Hover Tooltip**: Saat kursor disorot ke tombol yang sedang nonaktif, otomatis muncul keterangan **"Belum Ada Data Tersimpan"** yang intuitif bagi pengguna.

---

### 2. Struktur Basis Data (MySQL)

#### A. Tabel Baru: `rsia_asesmen_kebutuhan_edukasi` (RM 20)
```sql
CREATE TABLE `rsia_asesmen_kebutuhan_edukasi` (
  `no_rawat` varchar(17) NOT NULL,
  `tanggal` datetime NOT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `nip` varchar(20) NOT NULL,
  `agama_keyakinan` varchar(100) DEFAULT NULL,
  `bahasa_indonesia` enum('-','Aktif','Pasif') DEFAULT 'Aktif',
  `bahasa_daerah` varchar(50) DEFAULT 'Jawa',
  `bahasa_daerah_status` enum('-','Aktif','Pasif') DEFAULT 'Aktif',
  `bahasa_inggris` enum('-','Aktif','Pasif') DEFAULT '-',
  `bahasa_lain` varchar(50) DEFAULT NULL,
  `bahasa_lain_status` enum('-','Aktif','Pasif') DEFAULT '-',
  `perlu_penerjemah` enum('Tidak','Ya') DEFAULT 'Tidak',
  `penerjemah_bahasa` varchar(50) DEFAULT NULL,
  `bahasa_isyarat` enum('Tidak','Ya') DEFAULT 'Tidak',
  `bahasa_isyarat_ket` varchar(50) DEFAULT NULL,
  `cara_belajar` varchar(255) DEFAULT 'Diskusi, Audio visual/gambar',
  `tingkat_pendidikan` varchar(50) DEFAULT NULL,
  `pendidikan_lain` varchar(50) DEFAULT NULL,
  `mampu_membaca` enum('Ya','Tidak') DEFAULT 'Ya',
  `hambatan_emosi` enum('Tidak','Ya') DEFAULT 'Tidak',
  `kesediaan_menerima` enum('Ya','Tidak') DEFAULT 'Ya',
  `keterbatasan_fisik` enum('Tidak','Ya') DEFAULT 'Tidak',
  `kebutuhan_edukasi` text DEFAULT NULL,
  `kebutuhan_edukasi_lain` varchar(255) DEFAULT NULL,
  `rencana_pelaksanaan` enum('Individu','Kolaboratif') DEFAULT 'Individu',
  `tabel_rencana` json DEFAULT NULL,
  PRIMARY KEY (`no_rawat`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

#### B. Perubahan Kolom Tabel: `rsia_catatan_pelaksanaan_edukasi_pasien` (RM 23 & 24)
```sql
ALTER TABLE `rsia_catatan_pelaksanaan_edukasi_pasien`
  ADD COLUMN `jenis_form` ENUM('RM 23', 'RM 24') NOT NULL DEFAULT 'RM 23' AFTER `no_rawat`,
  ADD COLUMN `disiplin` ENUM('DPJP', 'Perawat/Bidan', 'Farmasi', 'Nutrisionis', 'Manajemen Nyeri', 'Lainnya') NULL AFTER `jenis_form`,
  ADD COLUMN `durasi` VARCHAR(20) NULL AFTER `tanggal`,
  ADD COLUMN `nama_penerima` VARCHAR(100) NULL AFTER `nip`,
  ADD COLUMN `ttd_pasien` VARCHAR(255) NULL AFTER `nama_penerima`,
  MODIFY COLUMN `materi` TEXT NULL,
  MODIFY COLUMN `metode` VARCHAR(255) NULL,
  MODIFY COLUMN `hambatan` VARCHAR(255) NULL,
  MODIFY COLUMN `intervensi` VARCHAR(255) NULL;
```

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/AsesmenKebutuhanEdukasi.php` | Model Eloquent untuk tabel `rsia_asesmen_kebutuhan_edukasi` (RM 20). |
| `app/Http/Controllers/AsesmenKebutuhanEdukasiController.php` | Controller API simpan/update dan render cetak PDF Form RM 20. |
| `resources/views/content/print/catatan_edukasi_rm20.blade.php` | Template cetak PDF resmi Form RM 20 (Pengkajian & Perencanaan Edukasi). |
| `resources/views/content/print/catatan_edukasi_rm23.blade.php` | Template cetak PDF resmi Form RM 23 (Edukasi Multidisiplin 5 PPA). |
| `resources/views/content/print/catatan_edukasi_rm24.blade.php` | Template cetak PDF resmi Form RM 24 (Tabel baris edukasi pasien umum). |
| `resources/views/content/print/catatan_edukasi_bundle.blade.php` | Template cetak PDF Bundling cerdas untuk menggabungkan RM 20, RM 23, dan RM 24 dalam 1 dokumen. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `routes/web.php` | Pendaftaran route `asesmen/kebutuhan/edukasi`, `catatan/pelaksanaan/edukasi/pasien/print/rm20`, dan `catatan/pelaksanaan/edukasi/pasien/print/bundle`. |
| `app/Http/Controllers/CatatanPelaksanaanEdukasiPasienController.php` | 1. Normalisasi array checkbox (`implode`) untuk metode, hambatan, intervensi.<br>2. Menambahkan method `printBundle()` untuk generate PDF paket edukasi gabungan. |
| `resources/views/content/ranap/modal/modal_catatan_edukasi_pasien.blade.php` | 1. Navigasi 3 Tab terpadu: **RM 20, RM 23, dan RM 24**.<br>2. Form interaktif RM 20 dengan tombol cepat *"Set Standar Normal"*.<br>3. Form RM 23 & 24 dengan multiple check metode/hambatan/intervensi dan TTD canvas.<br>4. Tombol Cetak RM 20, RM 23, RM 24, dan Cetak Bundling.<br>5. Fitur auto disable dan hover tooltip *"Belum Ada Data Tersimpan"* jika data belum disimpan. |
| `resources/views/content/print/catatan_edukasi_rm23.blade.php` | Menampilkan seluruh pilihan metode, hambatan, intervensi, checklist materi standar, baris *Catatan: ...* free-text, serta otomatisasi bukti paraf TTD digital dan nama penerima di kotak pernyataan. |
| `resources/views/content/print/catatan_edukasi_rm24.blade.php` | Menampilkan baris edukasi pasien dengan seluruh pilihan metode, hambatan, intervensi, serta otomatisasi bukti paraf TTD digital dan nama penerima di kotak pernyataan. |

---

## Modifikasi 3: BAB SKP (Monitoring Pelaporan Nilai Kritis & Penataan Tab SBAR IGD)

### 1. Deskripsi Perubahan
Pembaruan tata letak antarmuka dan alur monitoring untuk pemenuhan standar **Sasaran Keselamatan Pasien (SKP)**:
- **Penataan Tab Komunikasi Efektif (SBAR) di IGD**:
  - Tab **SBAR** pada modal pemeriksaan pasien IGD (`resources/views/content/ugd/modal/pemeriksaan.blade.php`) digeser posisinya tepat di samping tab **SOAP** (Urutan: `SOAP` &rarr; `SBAR` &rarr; `Data Pemeriksaan` &rarr; `CPPT Ranap` &rarr; `Resep` &rarr; `Tindakan` &rarr; `EWS`).
- **Fitur Monitoring Pelaporan Nilai Kritis Pasien**:
  - Tombol pintasan **"Monitoring Nilai Kritis"** ditambahkan pada toolbar/filter bar **UGD** dan **Rawat Inap (Ranap)** untuk memudahkan staf/dokter membuka panel pemantauan nilai kritis kapan saja.
  - Perbaikan query & filter default pada modal monitoring (`modal_tabel_hasil_kritis.blade.php`) agar otomatis menyaring data yang berstatus **"Belum diverifikasi"**.
  - Integritas waktu verifikasi (*real-time timestamp*) tetap dijaga otomatis oleh server saat petugas/dokter mengklik konfirmasi untuk mencegah manipulasi data medikolegal.

---

## Modifikasi 4: Standardisasi Pemanggilan Asset Statis & Router Server Lokal (*Asset Helper*)

### 1. Deskripsi Perubahan & Tujuan
Untuk menjaga portabilitas aplikasi saat dijalankan di berbagai environment (misalnya server lokal dengan `php artisan serve`, Apache virtual host, maupun subdirektori `/erm/`), dilakukan migrasi pemanggilan file statis dari jalur *hardcoded* (`/erm/public/...`) menjadi helper standar Laravel `{{ asset(...) }}`:
- **Logo Aplikasi**: Header navigasi utama disesuaikan agar logo RS selalu muncul konsisten tanpa *broken image*.
- **Icon & Stylesheet Font**: File stylesheet Bootstrap Icons pada layout `<head>` dimuat menggunakan helper `asset()`.
- **Preview Berkas Tanda Tangan Digital**: Penanganan URL tanda tangan pasien/keluarga yang tersimpan di disk fisik `storage/app/public/signatures/` dipastikan di-resolve melalui `{{ asset('storage') }}/...`.
- **Router Interceptor `server.php`**: Penanganan otomatis permintaan file statis ber-prefix `/erm/public/...` dan `/public/...` pada development server `php artisan serve` sehingga aset lokal maupun path produksi dapat disajikan langsung tanpa error 404.
- **Sanitasi Komponen Input HTML5 (`<x-input>`)**: Menghilangkan error format browser `The specified value "-" does not conform to the required format, "yyyy-MM-dd"` dengan mengatur default value string kosong `""` khusus untuk input berjenis `date`, `time`, `datetime-local`, dan `number`.

---

### 2. Daftar Berkas & Rincian Perubahan
| File | Rincian Perubahan |
| :--- | :--- |
| `server.php` | Menambahkan regex matcher `/^(\/erm)?\/public/` untuk melayani aset statis langsung saat menggunakan `php artisan serve`. |
| `resources/views/components/input.blade.php` | Memisahkan default value tipe input `date`/`time` menjadi `""` (bukan `"-"`) agar mematuhi standar HTML5. |
| `resources/views/index.blade.php` | Mengubah `src="/erm/public/img/logo.png"` menjadi `src="{{ asset('img/logo.png') }}"`. |
| `resources/views/layout/head.blade.php` | Mengubah `href='/erm/public/css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css'` menjadi `href="{{ asset('css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css') }}"`. |
| `resources/views/content/ugd/modal/asmed.blade.php` | Menyesuaikan URL preview tanda tangan dan sanitasi input tanggal selesai/meninggal. |

---

## Modifikasi 5: Pemeriksaan Fisik Status Generalis 13 Organ (Grid 2 Kolom Ringkas) & Kontrol Visibilitas Tombol Cetak

### 1. Deskripsi Perubahan
- **Tabel 13 Organ Status Generalis (Layout 2 Kolom Ringkas)**:
  - Menggantikan tampilan dropdown lama dengan antarmuka tabel 13 organ fisik yang disusun dalam **Grid 2 Kolom Berdampingan** (hemat 50% ruang vertikal agar tidak memakan space scroll ke bawah):
    - **Kolom Kiri (7 Organ)**: Kepala, Mata, THT *(Baru)*, Mulut, Leher, Jantung *(Baru)*, Paru-paru *(Baru)*.
    - **Kolom Kanan (6 Organ)**: Dada & Payudara, Perut, Urogenital, Anggota Gerak, Status Neurologis *(Baru)*, Muskuloskeletal *(Baru)*.
  - Setiap baris dilengkapi pilihan status `Normal`, `Abnormal`, dan `Tidak Diperiksa`.
  - Kolom teks **"Jika tidak normal, jelaskan"** otomatis nonaktif saat status `Normal` dan otomatis aktif + disorot warna kuning saat status `Abnormal`.
  - Dilengkapi tombol cepat **"Set Semua Normal"** di pojok kanan atas tabel untuk mempercepat waktu entri dokter IGD.
- **Kontrol Visibilitas Tombol Cetak**:
  - Tombol **"Cetak Asesmen"** disembunyikan (`d-none`) saat dokter membuka formulir untuk entri baru, dan baru dimunculkan jika data asesmen sudah pernah disimpan/sudah ada di database.
- **Sinkronisasi Otomatis Triage/Perawat**:
  - Saat membuka form entri baru, data TTV (Tensi, Nadi, RR, Suhu, SpO2, BB, TB, GCS, Kesadaran) dan Keluhan Utama ditarik otomatis dari `pemeriksaan_ralan`.
- **Integrasi Cetak PDF (A4 Proporsional & Lengkap)**:
  - Format cetak asesmen medis IGD (A4) diperbarui dengan menyusun tabel 13 organ fisik ke dalam **2 Kolom Berdampingan** (Kiri: 7 organ, Kanan: 6 organ) sehingga menghemat ruang vertikal secara signifikan.
  - Menambahkan bagian **Pemeriksaan Penunjang (Laboratorium, Radiologi, EKG)** dalam format tabel 3 kolom dan deskripsi **Status Lokalis**.

---

### 2. Struktur Basis Data (MySQL)

#### Perubahan Kolom Tabel: `rsia_penilaian_medis_igd` (18 Kolom 13 Organ Fisik)
```sql
ALTER TABLE `rsia_penilaian_medis_igd`
  ADD COLUMN `tht` enum('Normal','Abnormal','Tidak Diperiksa') DEFAULT 'Normal' AFTER `terapi_non_farmakologis`,
  ADD COLUMN `jantung` enum('Normal','Abnormal','Tidak Diperiksa') DEFAULT 'Normal' AFTER `tht`,
  ADD COLUMN `paru` enum('Normal','Abnormal','Tidak Diperiksa') DEFAULT 'Normal' AFTER `jantung`,
  ADD COLUMN `neurologis` enum('Normal','Abnormal','Tidak Diperiksa') DEFAULT 'Normal' AFTER `paru`,
  ADD COLUMN `muskuloskeletal` enum('Normal','Abnormal','Tidak Diperiksa') DEFAULT 'Normal' AFTER `neurologis`,
  ADD COLUMN `ket_kepala` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_mata` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_tht` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_gigi` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_leher` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_jantung` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_paru` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_thoraks` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_abdomen` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_genital` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_ekstremitas` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_neurologis` varchar(255) DEFAULT NULL,
  ADD COLUMN `ket_muskuloskeletal` varchar(255) DEFAULT NULL;
```

---

### 3. Daftar Berkas yang Dimodifikasi
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/AsesmenMedisIgdController.php` | Mapping 18 field baru pada `$rsiaFields` (`tht`, `jantung`, `paru`, `neurologis`, `muskuloskeletal`, dan 13 kolom `ket_*`) serta sinkronisasi ringkasan `ket_fisik` otomatis untuk backward-compatibility Khanza. |
| `resources/views/content/ugd/modal/asmed.blade.php` | Implementasi layout tabel 2 kolom 13 organ fisik, event handler status/keterangan, tombol cepat semua normal, visibilitas tombol cetak berbasis status data, dan auto pre-fill pemeriksaan awal. |
| `resources/views/content/print/asmed_igd.blade.php` | Menambahkan tabel 13 organ status generalis pada cetakan PDF Asesmen IGD. |

---

## Modifikasi 6: Fitur Transfer Pasien Antar Ruang (UGD & Rawat Inap)

### 1. Deskripsi Perubahan
Implementasi modul **Transfer Pasien Antar Ruang** mengadopsi struktur data standar `RMTransferPasienAntarRuang.java` SIMRS Khanza:
- **Antarmuka Formulir Interaktif & Modern**:
  - **Header Pasien**: Banner identitas pasien (No. Rawat, No. RM, Nama, Tgl Lahir, JK, Kamar/Ruangan saat ini).
  - **Bagian A (Informasi Pemindahan Ruang)**: Tanggal masuk, tanggal pindah, asal ruang, ruang selanjutnya/tujuan, metode pemindahan (*Kursi Roda, Tempat Tidur, Brankar, Berjalan*), dan indikasi pindah ruang (+ keterangan).
  - **Bagian B (Kondisi Klinis & Riwayat Tindakan)**: Diagnosa utama & sekunder, prosedur yang sudah dilakukan, obat yang telah diberikan, pemeriksaan penunjang, dan peralatan yang menyertai (+ keterangan).
  - **Bagian C (Persetujuan Pemindahan)**: Status persetujuan (*Ya/Tidak*), nama penanggung jawab, hubungan keluarga, dan **Tanda Tangan Digital Pasien/Keluarga** berbasis Canvas Touch/Mouse.
  - **Bagian D (Evaluasi TTV Sebelum vs Sesudah)**: *Side-by-side card* untuk membandingkan Keluhan Utama, Kesadaran/Keadaan Umum, Tekanan Darah (TD), Nadi, Respirasi (RR), dan Suhu Tubuh sebelum dan sesudah transfer.
  - **Bagian E (Serah Terima Petugas)**: Petugas yang menyerahkan (otomatis terisi dari user login) dan Petugas yang menerima (*Live Search Autocomplete* dari database pegawai/petugas).
- **Tab Riwayat Transfer Pasien**:
  - Daftar seluruh riwayat pemindahan pasien antar ruangan dengan tombol aksi **Edit**, **Hapus**, dan **Cetak PDF**.
- **Penyimpanan Tanda Tangan Fisik Ringan**:
  - Tanda tangan digital pasien disimpan sebagai file PNG di `storage/app/public/signatures/transfer_pasien/` dengan path relatif di database (sama seperti Asmed IGD) untuk efisiensi basis data.
- **Cetak Dokumen PDF Format A4 Resmi**:
  - Format standar rekam medis akreditasi rumah sakit dengan kop resmi RSIA Aisyiyah Pekajangan.
  - Tabel perbandingan kondisi klinis & TTV sebelum vs sesudah transfer.
  - **Verifikasi Elektronik (QRCode)** untuk tanda tangan staf internal (*Petugas Menyerahkan & Petugas Menerima*) serta embed tanda tangan digital pasien/keluarga.
- **Integrasi Menu**:
  - Tersedia di dropdown aksi pasien pada modul **UGD (`/erm/ugd`)** dan **Rawat Inap (`/erm/ranap`)**.

---

### 2. Struktur Basis Data (MySQL)

#### A. Tabel Utama: `transfer_pasien_antar_ruang` (Tabel Standar SIMRS Khanza)
```sql
CREATE TABLE IF NOT EXISTS `transfer_pasien_antar_ruang` (
  `no_rawat` varchar(17) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_pindah` datetime NOT NULL,
  `asal_ruang` varchar(30) DEFAULT NULL,
  `ruang_selanjutnya` varchar(30) DEFAULT NULL,
  `diagnosa_utama` varchar(50) DEFAULT NULL,
  `diagnosa_sekunder` varchar(100) DEFAULT NULL,
  `indikasi_pindah_ruang` enum('Kondisi Pasien Stabil','Kondisi Pasien Tidak Ada Perubahan','Kondisi Pasien Memburuk','Fasilitas Kurang Memadai','Fasilitas Butuh Lebih Baik','Tenaga Membutuhkan Yang Lebih Ahli','Tenaga Kurang','Lain-lain') DEFAULT NULL,
  `keterangan_indikasi_pindah_ruang` varchar(50) DEFAULT NULL,
  `prosedur_yang_sudah_dilakukan` varchar(800) DEFAULT NULL,
  `obat_yang_telah_diberikan` varchar(800) DEFAULT NULL,
  `metode_pemindahan_pasien` enum('Kursi Roda','Tempat Tidur','Brankar','Berjalan') DEFAULT NULL,
  `peralatan_yang_menyertai` enum('Oksigen Portable','Infus','NGT','Syringe Pump','Suction','Kateter Urin') DEFAULT NULL,
  `keterangan_peralatan_yang_menyertai` varchar(50) DEFAULT NULL,
  `pemeriksaan_penunjang_yang_dilakukan` varchar(500) DEFAULT NULL,
  `pasien_keluarga_menyetujui` enum('Ya','Tidak') DEFAULT 'Ya',
  `nama_menyetujui` varchar(50) DEFAULT NULL,
  `hubungan_menyetujui` enum('Kakak','Adik','Saudara','Keluarga','Kakek','Nenek','Orang Tua','Suami','Istri','Penanggung Jawab','Menantu','Ipar','Mertua','-') DEFAULT '-',
  `keluhan_utama_sebelum_transfer` varchar(200) DEFAULT NULL,
  `keadaan_umum_sebelum_transfer` enum('Compos Mentis','Gelisah','Delirium','Koma') DEFAULT NULL,
  `td_sebelum_transfer` varchar(7) DEFAULT NULL,
  `nadi_sebelum_transfer` varchar(5) DEFAULT NULL,
  `rr_sebelum_transfer` varchar(5) DEFAULT NULL,
  `suhu_sebelum_transfer` varchar(5) DEFAULT NULL,
  `keluhan_utama_sesudah_transfer` varchar(200) DEFAULT NULL,
  `keadaan_umum_sesudah_transfer` enum('Compos Mentis','Gelisah','Delirium','Koma') DEFAULT NULL,
  `td_sesudah_transfer` varchar(7) DEFAULT NULL,
  `nadi_sesudah_transfer` varchar(5) DEFAULT NULL,
  `rr_sesudah_transfer` varchar(5) DEFAULT NULL,
  `suhu_sesudah_transfer` varchar(5) DEFAULT NULL,
  `nip_menyerahkan` varchar(20) NOT NULL,
  `nip_menerima` varchar(20) NOT NULL,
  PRIMARY KEY (`no_rawat`,`tanggal_masuk`),
  KEY `nip_menyerahkan` (`nip_menyerahkan`),
  KEY `nip_menerima` (`nip_menerima`),
  CONSTRAINT `transfer_pasien_antar_ruang_ibfk_1` FOREIGN KEY (`no_rawat`) REFERENCES `reg_periksa` (`no_rawat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transfer_pasien_antar_ruang_ibfk_2` FOREIGN KEY (`nip_menyerahkan`) REFERENCES `petugas` (`nip`) ON UPDATE CASCADE,
  CONSTRAINT `transfer_pasien_antar_ruang_ibfk_3` FOREIGN KEY (`nip_menerima`) REFERENCES `petugas` (`nip`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

#### B. Tabel Tanda Tangan: `bukti_persetujuan_transfer_pasien_antar_ruang`
```sql
CREATE TABLE IF NOT EXISTS `bukti_persetujuan_transfer_pasien_antar_ruang` (
  `no_rawat` varchar(17) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `photo` longtext DEFAULT NULL,
  PRIMARY KEY (`no_rawat`,`tanggal_masuk`),
  CONSTRAINT `bukti_persetujuan_transfer_pasien_antar_ruang_ibfk_1` FOREIGN KEY (`no_rawat`, `tanggal_masuk`) REFERENCES `transfer_pasien_antar_ruang` (`no_rawat`, `tanggal_masuk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Alter penyesuaian kolom photo
ALTER TABLE `bukti_persetujuan_transfer_pasien_antar_ruang` 
  MODIFY COLUMN `photo` LONGTEXT NULL;
```

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/TransferPasienAntarRuang.php` | Model Eloquent tabel `transfer_pasien_antar_ruang` (Composite PK: `no_rawat` & `tanggal_masuk`). |
| `app/Models/BuktiPersetujuanTransferPasienAntarRuang.php` | Model Eloquent tabel `bukti_persetujuan_transfer_pasien_antar_ruang`. |
| `app/Http/Controllers/TransferPasienAntarRuangController.php` | Controller CRUD dan render cetak PDF transfer pasien antar ruang. |
| `resources/views/content/ranap/modal/modal_transfer_pasien.blade.php` | Modal form interaktif transfer pasien, canvas TTD, auto search petugas penerima, dan tab riwayat transfer. |
| `resources/views/content/print/transfer_pasien_antar_ruang.blade.php` | Template cetak PDF resmi format A4 dengan Kop, perbandingan TTV, TTD digital keluarga, dan QR Code petugas. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `routes/web.php` | Mendaftarkan route `/transfer/pasien/antar-ruang` (GET, POST, DELETE, PRINT). |
| `resources/views/content/ranap/ranap.blade.php` | Inklusi modal transfer dan penambahan item menu **"Transfer Pasien Antar Ruang"** pada dropdown aksi pasien Ranap. |
| `resources/views/content/ugd/ugd.blade.php` | Inklusi modal transfer dan penambahan item menu **"Transfer Pasien Antar Ruang"** pada dropdown aksi pasien UGD. |

---

## Modifikasi 7: Fitur Asesmen Keperawatan UGD (Penilaian Awal Keperawatan IGD & Skrining Gizi Dewasa/Anak)

### 1. Deskripsi Perubahan
Mengadopsi dan mengintegrasikan seluruh alur dan struktur data asesmen keperawatan IGD dari SIMRS Khanza (`RMPenilaianAwalKeperawatanIGD.java`) yang disempurnakan dengan fitur **Skrining Gizi Terintegrasi (MST & Strong-Kids)** ke dalam aplikasi ERM Web:
- **Formulir Interaktif Modern & Lengkap (8 Bagian)**:
  1. **I. Informasi & Anamnesis**: Autoanamnesis/Alloanamnesis, RPS/Keluhan Utama, RPD, RPO, Status Kehamilan Obstetrik (G/P/A/HPHT) otomatis aktif/nonaktif sesuai jenis kelamin.
  2. **II. Pemeriksaan Fisik Keperawatan**: Tekanan Intrakranial, Pupil, Neurosensorik/Muskuloskeletal, Integumen, Turgor Kulit, Edema, Mukosa Mulut, Perdarahan (cc & warna), Intoksikasi, Eliminasi BAB & BAK (default `-`, frekuensi, konsistensi, warna, keterangan).
  3. **III. Psikososial, Budaya & Spiritual**: Kondisi Psikologis, Riwayat Gangguan Jiwa, Perilaku Berisiko (pelaporan), Hubungan Keluarga, Tinggal Dengan, Nilai Budaya Khusus, Pendidikan PJ, Edukasi Pasien/Keluarga.
  4. **IV. Pengkajian Fungsi (ADL)**: Kemampuan Beraktivitas (Mandiri/Bantuan/Total), Aktivitas Fisik, Alat Bantu Jalan.
  5. **V. Penilaian Risiko Jatuh (Get Up and Go Test)**: Evaluasi 3 indikator berjalan dengan **Auto-Kalkulasi Cerdas** (*Tidak Berisiko*, *Risiko Rendah*, *Risiko Tinggi*).
  6. **VI. Pengkajian Skala Nyeri (PQRST)**: Skrining Nyeri Akut/Kronis, visual pain scale slider (0-10) berwarna, Provokes, Quality, Region (lokasi & radiasi), Timing (durasi), faktor pereda nyeri, lapor dokter.
  7. **VII. Skrining Gizi (Dewasa - MST & Anak - Strong-Kids)**:
     - **Auto-Detect Usia Pasien**: Otomatis memilih form **Strong-Kids** jika usia `< 18 tahun`, dan form **MST** jika usia `≥ 18 tahun` (dapat di-switch manual).
     - **Kalkulasi Real-Time**: Perhitungan skor total dan badge tingkat risiko (*Risiko Rendah*, *Risiko Sedang*, *Risiko Tinggi*) terhitung otomatis.
     - **Pelaporan Gizi**: Fitur notifikasi/lapor ke petugas gizi jika ditemukan risiko malnutrisi tinggi.
  8. **VIII. Masalah & Rencana Keperawatan (SDKI / Khanza)**: Checklist diagnosis keperawatan IGD interaktif dengan panel rencana intervensi dinamis yang muncul otomatis sesuai diagnosis terpilih.
- **Fitur Cetak PDF Resmi Format A4 (1 Halaman Pas)**:
  - Kop Rumah Sakit RSIA Aisyiyah Pekajangan dengan data identitas pasien.
  - Penataan tabel ringkas dan proporsional untuk seluruh Seksi I s.d. VIII.
  - Seluruh teks berwarna hitam solid (`#000000`) sesuai standar rekam medis fisik.
  - Tanda Tangan Elektronik QR Code Perawat Pengkaji UGD.
- **Integrasi Menu UGD**:
  - Tombol menu **"Asesmen Keperawatan UGD"** pada dropdown aksi pasien UGD dengan indikator centang hijau `cekList(row.askep_igd)`.

---

### 2. Struktur Basis Data

#### A. Tabel Standar SIMRS Khanza
- `penilaian_awal_keperawatan_igd` (Tabel Utama 69 kolom)
- `penilaian_awal_keperawatan_igd_masalah` (Tabel relasi masalah keperawatan terpilih)
- `penilaian_awal_keperawatan_ralan_rencana_igd` (Tabel relasi rencana keperawatan terpilih)
- `master_masalah_keperawatan_igd` & `master_rencana_keperawatan_igd` (Master diagnosis & intervensi)

#### B. Tabel Tambahan Skrining Gizi: `rsia_penilaian_gizi_igd`
Tabel relasi khusus *one-to-one* dengan `reg_periksa` (`no_rawat`) untuk menjaga kompatibilitas murni dengan Khanza versi Desktop:

```sql
CREATE TABLE IF NOT EXISTS `rsia_penilaian_gizi_igd` (
  `no_rawat` VARCHAR(17) NOT NULL,
  `kategori_pasien` ENUM('Dewasa', 'Anak') NOT NULL DEFAULT 'Dewasa',
  `sg1` VARCHAR(100) NOT NULL DEFAULT '-',
  `nilai1` INT(11) NOT NULL DEFAULT 0,
  `sg2` VARCHAR(100) NOT NULL DEFAULT '-',
  `nilai2` INT(11) NOT NULL DEFAULT 0,
  `sg3` VARCHAR(100) NOT NULL DEFAULT '-',
  `nilai3` INT(11) NOT NULL DEFAULT 0,
  `sg4` VARCHAR(100) NOT NULL DEFAULT '-',
  `nilai4` INT(11) NOT NULL DEFAULT 0,
  `total_skor` INT(11) NOT NULL DEFAULT 0,
  `tingkat_risiko` VARCHAR(50) NOT NULL DEFAULT 'Risiko Rendah',
  `lapor_gizi` ENUM('Tidak', 'Ya') NOT NULL DEFAULT 'Tidak',
  `ket_lapor` VARCHAR(100) NOT NULL DEFAULT '-',
  PRIMARY KEY (`no_rawat`),
  CONSTRAINT `fk_rsia_penilaian_gizi_igd_reg` 
    FOREIGN KEY (`no_rawat`) 
    REFERENCES `reg_periksa` (`no_rawat`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

**Rincian Parameter Skrining Gizi:**
| Field Tabel | **Dewasa (Metode MST)** | **Anak (Metode Strong-Kids)** |
| :--- | :--- | :--- |
| `kategori_pasien` | `'Dewasa'` | `'Anak'` |
| `sg1` & `nilai1` | Penurunan BB dalam 6 bulan terakhir (0, 1, 2, 3, 4) | Apakah pasien tampak kurus? (0, 1) |
| `sg2` & `nilai2` | Asupan makan berkurang karena nafsu makan turun (0, 1) | Penurunan BB sebulan terakhir / BB tdk naik (0, 1) |
| `sg3` & `nilai3` | `-` (0) | Diare >5x/hari, muntah >3x/hari, asupan turun (0, 1) |
| `sg4` & `nilai4` | `-` (0) | Penyakit / keadaan berisiko malnutrisi (0, 1) |
| `total_skor` | Penjumlahan: `nilai1 + nilai2` | Penjumlahan: `nilai1 + nilai2 + nilai3 + nilai4` |
| `tingkat_risiko` | `≥ 2` = Risiko Tinggi, `< 2` = Risiko Rendah | `≥ 4` = Risiko Tinggi, `1-3` = Risiko Sedang, `0` = Risiko Rendah |
| `lapor_gizi` | `Tidak` / `Ya` | `Tidak` / `Ya` |
| `ket_lapor` | Keterangan / Jam lapor konsul gizi | Keterangan / Jam lapor konsul gizi |

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/RsiaPenilaianGiziIgd.php` | Model Eloquent tabel `rsia_penilaian_gizi_igd` (Primary Key: `no_rawat`). |
| `resources/views/content/ugd/modal/modal_askep_igd.blade.php` | Modal form interaktif Asesmen Keperawatan UGD lengkap dengan kalkulasi risiko jatuh otomatis, visual pain scale, skrining gizi (MST & Strong-Kids), dan checklist SDKI. |
| `resources/views/content/print/askep_igd.blade.php` | Template cetak PDF resmi format A4 Akreditasi dengan Kop, tabel sistematis 1 halaman, skrining gizi, dan QR Code verifikasi perawat. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/AskepUgd.php` | Menetapkan `primaryKey = 'no_rawat'`, `incrementing = false`, relasi lengkap dan penambahan relasi *one-to-one* `gizi()`. |
| `app/Models/MasalahAskepUgd.php` | Menambahkan `$guarded = []` dan `$timestamps = false`. |
| `app/Models/RencanaAskepUgd.php` | Menambahkan `$guarded = []` dan `$timestamps = false`. |
| `app/Models/RegPeriksa.php` | Menambahkan relasi `askepIgd()`. |
| `app/Http/Controllers/UgdController.php` | Eager load `'askepIgd'` untuk indikator centang status pengisian di tabel UGD. |
| `app/Http/Controllers/AskepUgdController.php` | Implementasi method `get()`, `getMaster()`, `createOrUpdate()`, `hapus()`, dan `print()` dengan dukungan sinkronisasi tabel skrining gizi `rsia_penilaian_gizi_igd`. |
| `app/Http/Controllers/TrackerSqlController.php` | Null safety pada sesi NIK pegawai. |
| `routes/web.php` | Pendaftaran route `/ugd/asesmen/keperawatan` (GET, MASTER, SIMPAN, HAPUS, PRINT). |
| `resources/views/content/ugd/ugd.blade.php` | Inklusi `modal_askep_igd` dan penambahan menu aksi **"Asesmen Keperawatan UGD"**. |

---

## Modifikasi 8: Fitur Asesmen Keperawatan Kebidanan & Kandungan UGD

### 1. Deskripsi Perubahan
Mengintegrasikan modul pengkajian klinis keperawatan obstetri dan ginekologi gawat darurat (kebidanan) ke dalam layanan UGD:
- **Formulir Interaktif Komprehensif (6 Kartu Seksi / 11 Bagian)**:
  1. **I. Keadaan Umum & Tanda Vital**: Petugas/Bidan Pengkaji (Select2), Anamnesis (Auto/Allo), Tanggal Asesmen, TD, Nadi, RR, Suhu, GCS, BB, TB, LILA, dan Auto-Kalkulasi BMI.
  2. **II. Pemeriksaan Kebidanan & Penunjang**: TFU, TBJ, Letak, Presentasi, Penurunan, HIS/Kontraksi (frekuensi, kekuatan, durasi), Gerak Janin / BJJ (frekuensi & keteraturan), Pemeriksaan Dalam (Portio, Serviks, Ketuban, Hodge), serta Penunjang Kebidanan (Inspekulo, CTG, USG, Laboratorium, Lakmus, Evaluasi Panggul).
  3. **III. Riwayat Kesehatan, Reproduksi & Obstetri**: Keluhan Utama, Riwayat Menstruasi (Menarche, Siklus, Lama, Jumlah, Keteraturan, Keluhan), Riwayat Perkawinan (Status, Frekuensi, Usia Nikah 1/2/3 & Status), Riwayat Kehamilan Sekarang (HPHT dengan Auto-Kalkulasi Usia Hamil & HPL/TP, G, P, A, Hidup, Imunisasi TT), Riwayat Persalinan yang Lalu (Tabel CRUD Riwayat Partus), serta Riwayat KB & Ginekologi.
  4. **IV. Status Fungsional, Psikososial & Risiko Jatuh**: Alat Bantu, Prothesa, ADL (Mandiri/Dibantu), Status Psikologis, Hubungan Keluarga, Tinggal Bersama, Status Ekonomi, Budaya, Edukasi, serta Evaluasi Risiko Jatuh (*Get Up and Go Test*) dengan Auto-Kalkulasi Tingkat Risiko.
  5. **V. Skrining Gizi (MST) & Pengkajian Nyeri**: Penurunan BB 6 bulan terakhir, asupan makan berkurang, total skor gizi MST otomatis, serta Skrining Nyeri PQRST dengan visual color slider (0-10) dan pelaporan dokter.
  6. **VI. Masalah & Rencana Tindakan Kebidanan**: Diagnosis masalah kebidanan yang ditemukan dan rencana tindakan asuhan kebidanan yang diberikan.
- **Integrasi Menu UGD**:
  - Menu aksi **"Asesmen Keperawatan Kebidanan"** otomatis muncul pada dropdown aksi pasien wanita (`jk == 'P'`) dengan indikator centang hijau `cekList(row.askep_kebidanan)`.
  - Tombol CRUD lengkap (Simpan, Perbarui, Hapus dengan konfirmasi SweetAlert2, dan Cetak PDF A4 resmi).

---

### 2. Struktur Basis Data (Standar SIMRS Khanza)
- `penilaian_awal_keperawatan_kebidanan` (Primary Key: `no_rawat`)
- `riwayat_persalinan_pasien` (Relasi: `no_rkm_medis`)

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `resources/views/content/ugd/modal/modal_askep_kebidanan.blade.php` | Modal form interaktif Asesmen Keperawatan Kebidanan UGD lengkap dengan kalkulasi BMI, HPHT/TP, risiko jatuh, skrining gizi MST, visual pain slider, tabel partus, dan tombol cetak/hapus. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/RegPeriksa.php` | Menambahkan relasi `askepKebidanan()` ke model `AskepRalanKebidanan`. |
| `app/Http/Controllers/UgdController.php` | Eager load `'askepKebidanan'` untuk status centang hijau di DataTables UGD. |
| `app/Http/Controllers/AskepRalanKebidananController.php` | Menambahkan method `delete()` untuk menghapus data asesmen kebidanan. |
| `routes/partials/askep.php` | Mendaftarkan route `DELETE /asesmen-keperawatan/kandungan`. |
---

## Modifikasi 9: Sistem Triase Pre-Registrasi UGD (Sebelum Pendaftaran SIMRS)

### 1. Deskripsi Perubahan
Mengimplementasikan sistem **Triase Pre-Registrasi UGD (Triase Sebelum Pendaftaran/Registrasi SIMRS)** untuk menangani pasien yang baru tiba di UGD yang membutuhkan penanganan medis dan triase cepat sebelum terdaftar di loket pendaftaran SIMRS:
- **Tujuan & Manfaat**:
  - Pasien darurat dapat segera dilakukan penilaian Triase ATS (Australian Triage Scale 1-5), pengukuran Tanda Vital (TTV), dan pencatatan keluhan awal tanpa harus menunggu antrean pendaftaran SIMRS selesai.
  - Memastikan *Response Time* UGD memenuhi standar keselamatan pasien & akreditasi.
- **Fitur Utama**:
  1. **Quick Input Triase Pre-Registrasi**: Modal pencatatan triase dengan identitas temporary pasien (misal: *Mr. X / Ny. Anita*), estimasi umur, cara datang, alat transportasi, keluhan utama, TTV awal, dan tabel matriks indikator ATS I-V yang identik dengan Form Asmed UGD.
  2. **Auto-Generate ID Triase**: Penomoran otomatis format `TR-YYYYMMDD-XXXX` (contoh: `TR-20260826-0001`).
  3. **Multi-Layer Safety Linking System**:
     - Sistem penautan data triase temporary ke nomor rawat (`no_rawat`) pasien setelah pendaftaran SIMRS selesai.
     - Proteksi keselamatan pasien: Alert peringatan jika ada ketidaksesuaian Jenis Kelamin (*Gender Mismatch Alert*).
     - Fitur *Unlink* (Lepas Tautan) jika terjadi kesalahan penautan.
  4. **Auto-Pull & Live Auto-Fill ke Form Asmed UGD**:
     - Saat dokter/perawat membuka Form Asmed UGD untuk pasien yang telah ditautkan triase pre-reg, seluruh data TTV dan centang skala ATS I-V **otomatis ditarik dan terisi di Form Asmed UGD tanpa perlu ketik ulang**.
     - Tombol **`[ 🔗 Tarik Data Triase Pre-Reg ]`** langsung tersedia di header card Triase pada Form Asmed UGD (hanya tampil jika pasien belum pernah disimpan Asmed-nya dan data triase belum terhubung).
  5. **Navigasi Tab Form & Riwayat/Edit**:
     - Tab **Form Input / Edit Triase**: Untuk entri baru dan edit data triase.
     - Tab **Riwayat & Edit Data Triase**: Menampilkan riwayat 50 data triase pre-registrasi terakhir dengan fitur pencarian live, tombol **`[ ✏️ Ubah ]`**, dan tombol **`[ 🗑️ Hapus ]`** (khusus data unlinked).
     - Jika data triase yang diedit sudah berstatus `LINKED`, perubahan otomatis tersinkronisasi langsung ke tabel SIMRS Khanza `data_triase_igd` dan `rsia_data_triase_ugddetail_skala1...5`.
  6. **Sistem Otorisasi Ketat Dokter pada Asmed UGD**:
     - Validasi akun simpan Asmed UGD: Hanya akun yang terdaftar sebagai Dokter di tabel `dokter` yang diizinkan menyimpan Asmed UGD. Akun non-dokter/direksi/admin akan ditolak dengan pesan error yang ramah pengguna.

---

### 2. Struktur Basis Data (MySQL)

#### Tabel Baru: `rsia_triase_pre_registrasi`
Tabel penyimpanan utama data triase sebelum pasien terdaftar di SIMRS.

```sql
CREATE TABLE `rsia_triase_pre_registrasi` (
  `id_triase` varchar(30) NOT NULL COMMENT 'ID Unik Triase (contoh: TR-20260826-0001)',
  `tgl_triase` datetime NOT NULL COMMENT 'Waktu Pasien Tiba & Triase Dilakukan',
  `nama_pasien_temp` varchar(100) NOT NULL COMMENT 'Nama Pasien / Anonim (Mr. X / Ms. Y)',
  `jk` enum('L','P') DEFAULT 'L',
  `umur_temp` varchar(30) DEFAULT NULL COMMENT 'Estimasi Umur (misal: ~30 Th / Bayi)',
  `cara_masuk` varchar(50) DEFAULT NULL COMMENT 'Sendiri / Ambulans / Rujukan / Polisi',
  `alat_transportasi` varchar(50) DEFAULT NULL,
  `alasan_kedatangan` varchar(100) DEFAULT NULL,
  `keterangan_kedatangan` text DEFAULT NULL COMMENT 'Keluhan Utama',
  `kode_kasus` varchar(20) DEFAULT '006' COMMENT 'Foreign Key master_triase_macam_kasus',
  
  -- Tanda-tanda Vital (TTV) awal
  `tekanan_darah` varchar(15) DEFAULT NULL,
  `nadi` varchar(10) DEFAULT NULL,
  `pernapasan` varchar(10) DEFAULT NULL,
  `suhu` varchar(10) DEFAULT NULL,
  `saturasi_o2` varchar(10) DEFAULT NULL,
  `gcs` varchar(10) DEFAULT NULL,
  `nyeri` varchar(10) DEFAULT NULL,
  
  -- Hasil Triase
  `skala_triase` enum('1','2','3','4','5') NOT NULL COMMENT 'Skala Triase ATS',
  `kategori_triase` enum('MERAH','KUNING','HIJAU','HITAM') NOT NULL COMMENT 'Kategori Warna Triase',
  `detail_skala_json` json DEFAULT NULL COMMENT 'JSON array indikator ATS yang dicentang',
  
  -- Metadata Petugas & Status Linking SIMRS
  `nip_petugas` varchar(20) NOT NULL COMMENT 'NIP Perawat / Petugas Pengkaji',
  `status_link` enum('UNLINKED','LINKED') DEFAULT 'UNLINKED' COMMENT 'Status Penautan ke Registrasi SIMRS',
  `no_rawat` varchar(17) DEFAULT NULL COMMENT 'No Rawat SIMRS setelah di-link',
  `no_rkm_medis` varchar(15) DEFAULT NULL COMMENT 'No RM Pasien setelah di-link',
  `tgl_linked` datetime DEFAULT NULL COMMENT 'Waktu Penautan Dilakukan',
  `nip_linker` varchar(20) DEFAULT NULL COMMENT 'NIP Petugas yang Melakukan Penautan',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_triase`),
  KEY `idx_status_link` (`status_link`),
  KEY `idx_no_rawat` (`no_rawat`),
  KEY `idx_tgl_triase` (`tgl_triase`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

---

### 3. Daftar Berkas yang Ditambahkan & Dimodifikasi

#### A. Berkas Baru (*New Files*)
| File | Fungsi |
| :--- | :--- |
| `app/Models/RsiaTriasePreRegistrasi.php` | Model Eloquent untuk tabel `rsia_triase_pre_registrasi` beserta relasi ke petugas NIP. |
| `app/Http/Controllers/RsiaTriasePreRegistrasiController.php` | Controller handler untuk `store` (create & edit update), `getUnlinked`, `getRecentList`, `getDetail`, `link` (sinkronisasi otomatis ke `data_triase_igd` & `rsia_data_triase_ugddetail_skala1...5`), `unlink`, `getByNoRawat`, dan `destroy`. |
| `resources/views/content/ugd/modal/modal_triase_prereg.blade.php` | Modal form Quick Input Triase Pre-Reg dengan Nav Tabs (Input/Edit & Riwayat 50 data), matriks indikator ATS I-V, dan penanganan default value kosong. |
| `resources/views/content/ugd/modal/modal_link_triase_prereg.blade.php` | Modal penautan (*linking*) triase pre-reg ke pasien registrasi SIMRS dengan perbandingan data *side-by-side* dan alert proteksi *gender mismatch*. |

#### B. Berkas Dimodifikasi (*Modified Files*)
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/RegPeriksa.php` | Menambahkan relasi `triasePreReg()` ke model `RsiaTriasePreRegistrasi`. |
| `app/Http/Controllers/UgdController.php` | Eager load `'triasePreReg'` untuk menampilkan badge status `[🔗 Pre-Reg]` pada DataTables antrean UGD. |
| `app/Models/AsesmenMedisIgdController.php` | Menambahkan validasi otorisasi dokter ketat pada method `create()` dan `edit()` (menolak NIP non-dokter/direksi dengan pesan HTTP 403 yang informatif). |
| `routes/web.php` | Mendaftarkan seluruh route `/triase/prereg/...` (`unlinked`, `list`, `detail`, `simpan`, `link`, `unlink`, `delete`, `by-no-rawat`). |
| `resources/views/content/ugd/ugd.blade.php` | 1. Menambahkan tombol header **`[ + Triase Pre-Reg (Counter Badge) ]`**.<br>2. Menambahkan badge kolom triase `[🔗 Pre-Reg]` di tabel UGD.<br>3. Menambahkan JavaScript penanganan kalkulasi ATS matrix, AJAX linking/unlinking, live auto-fill, dan fungsi edit/hapus triase pre-reg. |
| `resources/views/content/ugd/modal/asmed.blade.php` | 1. Auto-pull data TTV dan ATS indikator dari Triase Pre-Reg saat dokter/perawat membuka Asmed UGD.<br>2. Menambahkan tombol **`[ 🔗 Tarik Data Triase Pre-Reg ]`** pada card-header Triase (dengan kondisi hanya tampil jika belum terisi Asmed/Triase).<br>3. Perbaikan CSS tabel triase menjadi *100% full-width* (tanpa margin samping).<br>4. Penanganan error alert SweetAlert2 yang informatif jika akun non-dokter mencoba menyimpan Asmed. |




