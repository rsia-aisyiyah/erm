<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenNyeriBalita extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_asesmen_nyeri_anak_3th7th';
    protected $guarded = [];
    public $timestamps = false;


    function pasien(){
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
    function petugas(){
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
}
