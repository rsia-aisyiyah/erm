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

### 2. Daftar Berkas yang Dimodifikasi
| File | Rincian Perubahan |
| :--- | :--- |
| `app/Models/AsesmenMedisIgdController.php` | Mapping 18 field baru pada `$rsiaFields` (`tht`, `jantung`, `paru`, `neurologis`, `muskuloskeletal`, dan 13 kolom `ket_*`) serta sinkronisasi ringkasan `ket_fisik` otomatis untuk backward-compatibility Khanza. |
| `resources/views/content/ugd/modal/asmed.blade.php` | Implementasi layout tabel 2 kolom 13 organ fisik, event handler status/keterangan, tombol cepat semua normal, visibilitas tombol cetak berbasis status data, dan auto pre-fill pemeriksaan awal. |
| `resources/views/content/print/asmed_igd.blade.php` | Menambahkan tabel 13 organ status generalis pada cetakan PDF Asesmen IGD. |




