<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanResepPulangRacikanDetail extends Model
{
    use HasFactory, Compoships;

    protected $table = 'permintaan_resep_pulang_racikan_detail';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }

    public function racikan()
    {
        return $this->belongsTo(PermintaanResepPulangRacikan::class, ['no_permintaan', 'no_racik'], ['no_permintaan', 'no_racik']);
    }
}
