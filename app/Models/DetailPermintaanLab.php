<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPermintaanLab extends Model
{
    use HasFactory, Compoships;
    protected $table = 'permintaan_detail_permintaan_lab';
    protected $guarded = [];
    public $timestamps = false;

    function permintaan(): BelongsTo
    {
        return $this->belongsTo(PermintaanLab::class, 'noorder', 'noorder');
    }
    function item(): BelongsTo
    {
        return $this->belongsTo(TemplateLaboratorium::class, ['kd_jenis_prw', 'id_template'], ['kd_jenis_prw', 'id_template']);
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
