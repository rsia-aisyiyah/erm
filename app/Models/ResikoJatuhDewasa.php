<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ResikoJatuhDewasa extends Model
{
    use HasFactory, Compoships;

    protected $table = 'penilaian_lanjutan_resiko_jatuh_dewasa';
    protected $guarded = [];
    public $timestamps = false;

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

}
