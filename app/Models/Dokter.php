<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Models\Spesialis;
use App\Models\PeriksaLab;
use App\Models\RegPeriksa;
use App\Models\MappingPoliklinik;
use App\Models\MappingDokterDpjpVlcaim;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory, Compoships;
    protected $table = 'dokter';

    public function mappingPoli()
    {
        return $this->hasMany(MappingPoliklinik::class, 'kd_dokter', 'kd_dokter');
    }

    public function mappingDokter()
    {
        return $this->hasOne(MappingDokterDpjpVlcaim::class, 'kd_dokter', 'kd_dokter');
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
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kd_dokter', 'kd_dokter');
    }
}
