<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPemberianObatPasien extends Model
{
    use HasFactory;

    protected $table = 'catatan_pemberian_obat_pasien';
    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }

    public function pegawaiPerawat()
    {
        return $this->belongsTo(Pegawai::class, 'nip_perawat', 'nik');
    }

    public function pegawaiFarmasi()
    {
        return $this->belongsTo(Pegawai::class, 'nip_farmasi', 'nik');
    }
}
