<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomunikasiEdukasiObatPulang extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_formulir_komunikasi_edukasi_obat_pulang';
    protected $guarded = [];
    public $timestamps = false;

    public function obat()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function petugas()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
}
