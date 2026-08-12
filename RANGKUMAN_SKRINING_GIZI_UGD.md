# Rangkuman Implementasi Skrining Gizi - Asesmen Keperawatan IGD (UGD)

Dokumen ini berisi dokumentasi teknis penambahan tabel, struktur query DDL SQL, relasi Eloquent model, integrasi controller, modal antarmuka (UI/UX), dan format dokumen cetak untuk fitur **Skrining Gizi (MST Dewasa & Strong-Kids Anak)** pada modul Asesmen Keperawatan Gawat Darurat RSIA Aisyiyah Pekajangan.

---

## 1. Query DDL SQL Penambahan Tabel

Nama Tabel: `rsia_penilaian_gizi_igd`  
Relasi: *One-to-One* dengan `reg_periksa` (`no_rawat`)

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

---

## 2. Rincian Mapping & Logika Skor

| Field Tabel | **Dewasa (Metode MST)** | **Anak (Metode Strong-Kids)** |
| :--- | :--- | :--- |
| `kategori_pasien` | `'Dewasa'` | `'Anak'` |
| `sg1` & `nilai1` | Penurunan BB dalam 6 bulan terakhir:<br>&bull; Tidak Ada = 0<br>&bull; Ragu-ragu / Tidak Yakin = 2<br>&bull; Ya, 1–5 kg = 1<br>&bull; Ya, 6–10 kg = 2<br>&bull; Ya, 11–15 kg = 3<br>&bull; Ya, >15 kg = 4 | Apakah pasien tampak kurus?<br>&bull; Tidak = 0<br>&bull; Ya = 1 |
| `sg2` & `nilai2` | Asupan makan berkurang karena penurunan nafsu makan:<br>&bull; Tidak = 0<br>&bull; Ya = 1 | Penurunan BB sebulan terakhir / BB tdk naik (bayi <1 th):<br>&bull; Tidak = 0<br>&bull; Ya = 1 |
| `sg3` & `nilai3` | `-` (Nilai 0) | Diare >5x/hari, muntah >3x/hari, atau asupan turun seminggu terakhir:<br>&bull; Tidak = 0<br>&bull; Ya = 1 |
| `sg4` & `nilai4` | `-` (Nilai 0) | Penyakit / keadaan berisiko malnutrisi:<br>&bull; Tidak = 0<br>&bull; Ya = 1 |
| `total_skor` | Penjumlahan: `nilai1 + nilai2` | Penjumlahan: `nilai1 + nilai2 + nilai3 + nilai4` |
| `tingkat_risiko` | &bull; Skor 0–1 : **Risiko Rendah**<br>&bull; Skor ≥ 2 : **Risiko Tinggi** *(Auto suggest lapor gizi)* | &bull; Skor 0 : **Risiko Rendah**<br>&bull; Skor 1–3 : **Risiko Sedang**<br>&bull; Skor 4–5 : **Risiko Tinggi** *(Auto suggest lapor gizi)* |
| `lapor_gizi` | `Tidak` / `Ya` | `Tidak` / `Ya` |
| `ket_lapor` | Keterangan / Jam lapor konsul gizi | Keterangan / Jam lapor konsul gizi |

---

## 3. Struktur Berkas yang Terlibat

### 1. Model Eloquent
- **`app/Models/RsiaPenilaianGiziIgd.php`**: Model untuk tabel `rsia_penilaian_gizi_igd`.
- **`app/Models/AskepUgd.php`**: Menambahkan relasi *one-to-one* `gizi()`.

### 2. Backend Controller
- **`app/Http/Controllers/AskepUgdController.php`**:
  - `get()`: Eager loading relasi `gizi`.
  - `createOrUpdate()`: Menyimpan dan memperbarui data gizi di `rsia_penilaian_gizi_igd` bersamaan dengan `penilaian_awal_keperawatan_igd` dalam 1 database transaction.
  - `hapus()`: Menghapus data `rsia_penilaian_gizi_igd` saat asesmen dihapus.
  - `print()`: Mengirim relasi `gizi` ke template cetak PDF.

### 3. Modal Antarmuka (UI/UX)
- **`resources/views/content/ugd/modal/modal_askep_igd.blade.php`**:
  - Penambahan Seksi **VII. SKRINING GIZI** dengan panel dinamis Dewasa & Anak.
  - **Auto-Detect Umur Pasien**: Otomatis berpindah ke mode **Anak (Strong-Kids)** jika usia `< 18 tahun`, dan **Dewasa (MST)** jika usia `≥ 18 tahun`.
  - **Kalkulasi Skor Real-Time**: Perhitungan skor total dan badge warna tingkat risiko berjalan otomatis saat opsi dipilih.
  - **Reset Form Otomatis**: Form gizi ter-reset bersih setiap kali modal dibuka untuk pasien lain.

### 4. Layout Cetak Dokumen (PDF)
- **`resources/views/content/print/askep_igd.blade.php`**:
  - Penambahan tabel **VII. SKRINING GIZI** (menyesuaikan format Dewasa / Anak secara responsif).
  - Penyesuaian margin dan font size agar dokumen tetap rapi dan **pas dalam 1 halaman**.
