<?php

namespace App\Models;

use App\Models\DetailPermintaanLab;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PermintaanLab extends Model
{
    use HasFactory, Compoships;
    protected $table = 'permintaan_lab';
    protected $guarded = [];
    public $timestamps = false;

    function pemeriksaan(): HasMany
    {
        return $this->hasMany(PermintaanPemeriksaanLab::class, 'noorder', 'noorder');
    }
    function detail(): HasMany
    {
        return $this->hasMany(DetailPermintaanLab::class, 'noorder', 'noorder');
    }
    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }

    function hasil()
    {
        return $this->hasMany(PeriksaLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasil'])
            ->where('kd_jenis_prw', '!=', 'J000019');
    }
    function saranKesan()
    {
        return $this->hasOne(SaranKesanLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasil']);
    }
    function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
}
