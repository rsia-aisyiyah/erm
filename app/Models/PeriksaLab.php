<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaLab extends Model
{
    use HasFactory;
    protected $table = 'periksa_lab';


    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function jnsPerawatanLab()
    {
        return $this->hasMany(JnsPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    public function perujuk()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }
}
