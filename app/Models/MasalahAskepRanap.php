<?php

namespace App\Models;

use App\Models\AskepRanapAnak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasalahAskepRanap extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_ranap_masalah';
    protected $guarded = [];
    public $timestamps = false;

    function askepRanapAnak()
    {
        return $this->belongsTo(AskepRanapAnak::class, 'no_rawat', 'no_rawat');
    }
    function masterMasalah()
    {
        return $this->hasOne(MasterMasalahKeperawatan::class, 'kode_masalah', 'kode_masalah');
    }
    function rencanaKeperawatan()
    {
        return $this->hasMany(RencanaAskepRanap::class, 'no_rawat', 'no_rawat');
    }
}
