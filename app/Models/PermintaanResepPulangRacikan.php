<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanResepPulangRacikan extends Model
{
    use HasFactory, Compoships;

    protected $table = 'permintaan_resep_pulang_racikan';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanResepPulang::class, 'no_permintaan', 'no_permintaan');
    }

    public function detail()
    {
        return $this->hasMany(PermintaanResepPulangRacikanDetail::class, ['no_permintaan', 'no_racik'], ['no_permintaan', 'no_racik']);
    }
}
