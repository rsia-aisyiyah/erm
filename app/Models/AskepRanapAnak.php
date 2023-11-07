<?php

namespace App\Models;

use App\Models\MasalahAskepRanap;
use App\Models\RencanaAskepRanap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AskepRanapAnak extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_ranap_anak';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    function pengkaji1()
    {
        return $this->belongsTo(Petugas::class, 'nip1', 'nip');
    }
    function pengkaji2()
    {
        return $this->belongsTo(Petugas::class, 'nip2', 'nip');
    }
    function kamarInap()
    {
        return $this->belongsTo(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    function masalahKeperawatan()
    {
        return $this->hasMany(MasalahAskepRanap::class, 'no_rawat', 'no_rawat');
    }
    function rencanaKeperawatan()
    {
        return $this->hasMany(RencanaAskepRanap::class, 'no_rawat', 'no_rawat');
    }
}
