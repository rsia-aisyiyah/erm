<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemeriksaanRalan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan_ralan';
    public $timestamps = false;
    public $guarded = [];
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    function grafik()
    {
        return $this->hasMany(GrafikHarian::class, 'no_rawat', 'no_rawat');
    }
    function log()
    {
        return $this->hasMany(RsiaLogSoap::class, 'no_rawat', 'no_rawat');
    }


}
