<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAskepRanap extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_ranap_rencana';
    protected $guarded = [];
    public $timestamps = false;

    function masterRencana()
    {
        return $this->belongsTo(MasterRencanaKeperawatan::class, 'kode_rencana', 'kode_rencana');
    }
    function masterMasalah()
    {
        return $this->belongsTo(MasterMasalahKeperawatan::class, 'kode_masalah', 'kode_masalah');
    }
}
