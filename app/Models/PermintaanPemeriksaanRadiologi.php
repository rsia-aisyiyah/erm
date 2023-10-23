<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPemeriksaanRadiologi extends Model
{
    use HasFactory;
    protected $table = 'permintaan_pemeriksaan_radiologi';
    function jnsPemeriksaan()
    {
        return $this->belongsTo(JenisPerawatanRadiologi::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
}
