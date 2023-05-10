<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';

    public function mappingPoli()
    {
        return $this->hasMany(
            MappingPoliklinik::class,
            'kd_dokter',
            'kd_dokter'
        );
    }
    public function regPeriksa()
    {
        return $this->hasMany(RegPeriksa::class, 'kd_dokter', 'kd_dokter');
    }
    public function periksaLab()
    {
        return $this->hasMany(PeriksaLab::class, 'kd_dokter', 'kd_dokter');
    }
    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'kd_sps', 'kd_sps');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'kd_dokter', 'nik');
    }
}
