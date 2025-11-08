<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermintaanRadiologi extends Model
{
    use HasFactory;
    protected $table = 'permintaan_radiologi';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokterRujuk()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }
    function periksaRadiologi()
    {
        return $this->hasMany(PeriksaRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function hasilRadiologi()
    {
        return $this->hasMany(HasilRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function gambarRadiologi()
    {
        return $this->hasMany(GambarRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function permintaanPemeriksaan()
    {
        return $this->hasMany(PermintaanPemeriksaanRadiologi::class, 'noorder', 'noorder');
    }
	function pasien(){
		return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}
    function scoopeRadiologiLengkap($query)
    {
        return $radiologi = DB::table('permintaan_radiologi')
            ->join('periksa_radiologi', 'periksa_radiologi.no_rawat', '=', 'permintaan_radiologi.no_rawat')
            ->join('periksa_radiologi', 'periksa_radiologi.tgl_periksa', '=', 'permintaan_radiologi.tgl_hasil')
            ->join('periksa_radiologi', 'periksa_radiologi.jam', '=', 'permintaan_radiologi.jam_hasil');
    }
}
