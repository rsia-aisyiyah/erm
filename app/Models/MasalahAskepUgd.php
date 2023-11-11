<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasalahAskepUgd extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_igd_masalah';

    function masterMasalah()
    {
        return $this->belongsTo(MasterMasalahAskepUgd::class, 'kode_masalah', 'kode_masalah');
    }

    function rencanaKeperawatan()
    {
        return $this->hasMany(RencanaAskepUgd::class, 'no_rawat', 'no_rawat');
    }
}
