<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResikoJatuhAnak extends Model
{
    use HasFactory, Compoships;
    protected $guarded = [];
    public $timestamps = false;

    protected $table = 'penilaian_lanjutan_resiko_jatuh_anak';
    function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rkm_medis', 'no_rkm_medis', 'no_rawat', 'no_rawat');
    }
    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    function departemen()
    {
        return $this->hasOneThrough(Departemen::class, Pegawai::class, 'nip', 'nik', 'departemen', 'dep_id');
    }
}
