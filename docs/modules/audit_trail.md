# Dokumentasi Audit Trail Log

## Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Arsitektur](#arsitektur)
- [Trait AuditTrail](#trait-audittrail)
  - [Boot Events](#boot-events)
  - [Method writeAudit](#method-writeaudit)
  - [Method yang Dapat Di-override](#method-yang-dapat-di-override)
- [Integrasi pada Model](#integrasi-pada-model)
  - [Contoh Implementasi](#contoh-implementasi)
  - [Override Method](#override-method)
- [Data yang Dicatat](#data-yang-dicatat)
- [Alur Kerja](#alur-kerja)
- [Penanganan Error](#penanganan-error)
- [Panduan Penggunaan](#panduan-penggunaan)

---

## Gambaran Umum

**AuditTrail** adalah sebuah Laravel Trait yang berfungsi untuk mencatat setiap aktivitas perubahan data (INSERT, UPDATE, DELETE) secara otomatis pada model Eloquent. Log ini disimpan ke tabel `audit_logs` beserta detail perubahan field pada setiap operasi UPDATE.

Sistem ini dirancang untuk mendukung kebutuhan **rekam medis elektronik (RME)**, di mana setiap perubahan data pasien dan kunjungan harus dapat ditelusuri (*traceable*) dan dapat dipertanggungjawabkan.

---

## Arsitektur

```
App\Traits\AuditTrail
        │
        ├── Boot Events (created / updated / deleted)
        │         └── writeAudit(action)
        │
        ├── App\Models\AuditLog          ← Header log
        │         └── details()          ← Detail perubahan field (khusus UPDATE)
        │
        └── Method yang dapat di-override per model:
                  ├── getAuditModule()
                  ├── getAuditKeys()
                  ├── getAuditNoRawat()
                  └── getAuditNoRm()
```

---

## Trait AuditTrail

**Namespace:** `App\Traits\AuditTrail`
**File:** `app/Traits/AuditTrail.php`

### Boot Events

Trait ini mendaftarkan tiga Eloquent model event secara otomatis melalui method `bootAuditTrail()`:

| Event       | Aksi yang Dicatat |
|-------------|-------------------|
| `created`   | `INSERT`          |
| `updated`   | `UPDATE`          |
| `deleted`   | `DELETE`          |

> **Catatan:** Method boot dipanggil otomatis oleh Laravel karena mengikuti konvensi penamaan `boot{TraitName}`.

---

### Method writeAudit

```php
protected function writeAudit(string $action): void
```

Method utama yang menangani penulisan log. Alur eksekusinya:

1. Mengambil data pegawai dari `session('pegawai')`.
2. Membuat record header di `AuditLog` dengan informasi lengkap.
3. Jika aksi adalah `UPDATE`, iterasi semua field yang berubah (`getChanges()`) dan simpan nilai lama (`getOriginal()`) serta nilai baru ke tabel `audit_log_details`.
4. Field `updated_at` dan `created_at` dikecualikan dari pencatatan detail.
5. Jika terjadi error, exception dilaporkan via `report($e)` tanpa menghentikan proses utama.

---

### Method yang Dapat Di-override

Semua method berikut memiliki nilai default dan **dapat di-override** pada masing-masing model sesuai kebutuhan.

#### `getAuditModule(): string`

Mengembalikan nama modul untuk keperluan identifikasi log.

- **Default:** nama tabel dalam huruf kapital (`strtoupper($this->getTable())`)
- **Override:** definisikan nama modul yang lebih spesifik

```php
protected function getAuditModule(): string
{
    return 'ASKEP_AWAL_RAWAT_JALAN_KANDUNGAN';
}
```

---

#### `getAuditKeys(): array`

Mengembalikan primary key (atau composite key) sebagai array asosiatif.

- **Default:** `[$this->getKeyName() => $this->getKey()]`
- **Override:** gunakan untuk composite key atau PK non-standar

```php
protected function getAuditKeys(): array
{
    return [
        'no_rawat' => $this->no_rawat,
    ];
}
```

---

#### `getAuditNoRawat(): ?string`

Mengembalikan nomor rawat yang terkait dengan record.

- **Default:** `$this->no_rawat ?? null`
- **Override:** sesuaikan jika nama atribut berbeda

---

#### `getAuditNoRm(): ?string`

Mengembalikan nomor rekam medis pasien.

- **Default:** `$this->no_rkm_medis ?? null`
- **Override:** gunakan relasi jika nomor RM tidak tersimpan langsung di tabel

```php
protected function getAuditNoRm(): ?string
{
    return $this->regPeriksa?->no_rkm_medis;
}
```

---

## Integrasi pada Model

### Contoh Implementasi

Berikut contoh penerapan pada model `PenilaianAwalKeperawatanKebidanan`:

```php
use HasFactory, Compoships, AuditTrail;

protected $table = 'penilaian_awal_keperawatan_kebidanan';
protected $guarded = [];
public $timestamps = false;
protected $primaryKey = 'no_rawat';
protected $keyType = 'string';
public $incrementing = false;

protected function getAuditKeys(): array
{
    return [
        'no_rawat' => $this->no_rawat,
    ];
}

protected function getAuditModule(): string
{
    return 'ASKEP_AWAL_RAWAT_JALAN_KANDUNGAN';
}

protected function getAuditNoRm(): ?string
{
    return $this->regPeriksa?->no_rkm_medis;
}
```

### Override Method

| Method               | Kapan Di-override                                                              |
|----------------------|--------------------------------------------------------------------------------|
| `getAuditModule()`   | Selalu, agar nama modul lebih deskriptif daripada nama tabel                   |
| `getAuditKeys()`     | Jika model menggunakan composite key atau primary key non-standar              |
| `getAuditNoRawat()`  | Jika atribut `no_rawat` tidak ada atau bernama lain                            |
| `getAuditNoRm()`     | Jika nomor RM diambil dari relasi, bukan dari kolom langsung di tabel          |

---

## Data yang Dicatat

### Header Log (`audit_logs`)

| Field          | Sumber Data                            | Keterangan                              |
|----------------|----------------------------------------|-----------------------------------------|
| `module`       | `getAuditModule()`                     | Nama modul/fitur                        |
| `table_name`   | `$this->getTable()`                    | Nama tabel database                     |
| `entity_keys`  | `getAuditKeys()`                       | Primary key record (JSON)               |
| `no_rawat`     | `getAuditNoRawat()`                    | Nomor kunjungan rawat                   |
| `no_rkm_medis` | `getAuditNoRm()`                       | Nomor rekam medis pasien                |
| `audit_action` | Parameter `$action`                    | `INSERT` / `UPDATE` / `DELETE`          |
| `user_id`      | `session('pegawai')->nik`              | NIK pegawai yang melakukan aksi         |
| `username`     | `session('pegawai')->nama`             | Nama pegawai yang melakukan aksi        |
| `ip_address`   | `request()->ip()`                      | Alamat IP pengguna                      |
| `url`          | `request()->fullUrl()`                 | URL lengkap saat aksi terjadi           |

### Detail Perubahan (`audit_log_details`) — khusus UPDATE

| Field        | Keterangan                             |
|--------------|----------------------------------------|
| `field_name` | Nama kolom yang berubah                |
| `old_value`  | Nilai sebelum diubah                   |
| `new_value`  | Nilai setelah diubah                   |

> Field `updated_at` dan `created_at` **tidak dicatat** dalam detail perubahan.

---

## Alur Kerja

```
User melakukan aksi (simpan / ubah / hapus)
          │
          ▼
Eloquent Model Event terpicu (created / updated / deleted)
          │
          ▼
writeAudit($action) dipanggil
          │
          ├── Ambil session pegawai
          ├── Buat record AuditLog (header)
          │
          └── Jika UPDATE:
                    ├── Loop getChanges()
                    ├── Skip 'updated_at', 'created_at'
                    └── Buat AuditLogDetail (old_value / new_value)
```

---

## Penanganan Error

Seluruh logika audit dibungkus dalam blok `try-catch`:

```php
try {
    // ... logika audit
} catch (\Throwable $e) {
    report($e);
}
```

- Error yang terjadi **tidak akan menggagalkan** operasi utama (INSERT/UPDATE/DELETE pada model).
- Exception tetap dilaporkan melalui sistem logging Laravel (`report()`), sehingga dapat dipantau via log file atau error tracking (misalnya Sentry, Bugsnag).

---

## Panduan Penggunaan

### Menambahkan Audit Trail ke Model Baru

1. Tambahkan `use AuditTrail;` di dalam class model.
2. Pastikan `use App\Traits\AuditTrail;` di-import di bagian atas file.
3. Override minimal `getAuditModule()` agar nama modul bermakna.
4. Override `getAuditKeys()` jika model menggunakan composite key.
5. Override `getAuditNoRm()` jika nomor RM diambil dari relasi.

```php
<?php

namespace App\Models;

use App\Traits\AuditTrail;
use Illuminate\Database\Eloquent\Model;

class NamaModel extends Model
{
    use AuditTrail;

    protected $table = 'nama_tabel';

    protected function getAuditModule(): string
    {
        return 'NAMA_MODUL';
    }

    protected function getAuditKeys(): array
    {
        return [
            'no_rawat'    => $this->no_rawat,
            'kd_dokter'   => $this->kd_dokter, // contoh composite key
        ];
    }

    protected function getAuditNoRm(): ?string
    {
        return $this->relasiPasien?->no_rkm_medis;
    }
}
```

### Hal-hal yang Perlu Diperhatikan

- **Session `pegawai`** harus tersedia saat operasi model dilakukan. Jika tidak ada, `user_id` dan `username` akan tercatat sebagai `null`.
- Model yang menggunakan **soft delete** (`SoftDeletes`) perlu dipastikan event `deleted` yang tercatat adalah soft delete, bukan hard delete.
- Untuk model dengan **composite primary key** (menggunakan trait `Compoships`), pastikan `getAuditKeys()` mengembalikan semua kolom kunci.
- Pastikan model `AuditLog` dan relasi `details()` sudah dikonfigurasi dan tabel terkait sudah ada di database.