<?php

namespace App\Models;

use App\Models\JenisPerawatanRadiologi;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriksaRadiologi extends Model
{
    use HasFactory, Compoships;
    protected $table = 'periksa_radiologi';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function permintaanRadiologi()
    {
        return $this->hasOne(PermintaanRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function permintaan()
    {
        return $this->hasMany(PermintaanRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function jnsPerawatan()
    {
        return $this->belongsTo(JenisPerawatanRadiologi::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    function gambarRadiologi()
    {
        return $this->hasMany(GambarRadiologi::class, ['no_rawat', 'tgl_periksa'], ['no_rawat', 'tgl_periksa']);
    }
    function hasilRadiologi()
    {
        return $this->hasMany(HasilRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    function dokterRujuk()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
