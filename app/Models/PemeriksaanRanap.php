<?php

namespace App\Models;

use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Models\GrafikHarian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemeriksaanRanap extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan_ranap';
    public $timestamps = false;
    protected $fillable = ['suhu_tubuh', 'no_rawat', 'tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'tinggi', 'berat', 'spo2', 'kesadaran', 'gcs', 'keluhan', 'pemeriksaan', 'alergi', 'lingkar_perut', 'rtl', 'penilaian', 'instruksi', 'evaluasi', 'nip', 'o2'];
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function grafikHarian()
    {
        return $this->hasMany(GrafikHarian::class, 'no_rawat', 'no_rawat');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
}
