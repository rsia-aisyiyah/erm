<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Models\RegPeriksa;
use App\Models\MasalahAskepRanap;
use App\Models\RencanaAskepRanap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AskepUgd extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_igd';
    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    function pengkaji()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function masalahKeperawatan()
    {
        return $this->hasMany(MasalahAskepUgd::class, 'no_rawat', 'no_rawat');
    }
    function rencanaKeperawatan()
    {
        return $this->hasMany(RencanaAskepUgd::class, 'no_rawat', 'no_rawat');
    }
    function gizi()
    {
        return $this->hasOne(RsiaPenilaianGiziIgd::class, 'no_rawat', 'no_rawat');
    }
}
