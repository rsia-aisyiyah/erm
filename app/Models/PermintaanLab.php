<?php

namespace App\Models;

use App\Models\DetailPermintaanLab;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

}
