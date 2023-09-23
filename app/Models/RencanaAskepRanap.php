<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAskepRanap extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_ranap_rencana';

    function masterRencana()
    {
        return $this->hasMany(MasterRencanaKeperawatan::class, 'kode_rencana', 'kode_rencana');
    }
    function masterMasalah()
    {
        return $this->belongsTo(MasterMasalahKeperawatan::class, 'kode_masalah', 'kode_masalah');
    }
}
