<?php

namespace App\Models;

use App\Models\Petugas;
use App\Models\RegPeriksa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrafikHarian extends Model
{
    use HasFactory;
    protected $table = 'rsia_grafik_harian';
    public $timestamps = false;
    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

    public function pegawai()
    {
        // pegawai nik
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    public function verifikasi(){
        return $this->hasOne(RsiaVerifPemeriksaanRanap::class, 'no_rawat', 'no_rawat');
    }
}
