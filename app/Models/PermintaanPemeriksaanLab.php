<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use App\Models\DetailPermintaanLab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermintaanPemeriksaanLab extends Model
{
    use HasFactory, Compoships;
    protected $table = 'permintaan_pemeriksaan_lab';
    protected $guarded = [];
    public $timestamps = false;


    function detail(): HasMany
    {
        return $this->hasMany(DetailPermintaanLab::class, ['noorder', 'kd_jenis_prw'], ['noorder', 'kd_jenis_prw']);
    }
    function jenis(): BelongsTo
    {
        return $this->belongsTo(JnsPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    function saranKesan()
    {
        return $this->hasOne(SaranKesanLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasils']);
    }
}
