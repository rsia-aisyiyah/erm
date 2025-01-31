<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\Pegawai;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use App\Models\RsiaVerifPemeriksaanRanap;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaGrafikHarian extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_grafik_harian';
    public $timestamps = false;
    public $guarded = [];

    // protected $fillable = [
    //     'no_rawat','tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 
    //     'respirasi', 'spo2', 'o2', 'gcs', 'kesadaran', 'sumber', 'nip',
    // ];
    public function verifikasi(){
        return $this->hasOne(RsiaVerifPemeriksaanRanap::class, 'no_rawat', 'no_rawat');
    }

    public function dokter(){
        return $this->belongsTo(Dokter::class, 'nip', 'nip');
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
}
