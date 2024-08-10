<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class RsiaAsuhanGiziDewasa extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_asuhan_gizi_dewasa';
    protected $guarded = [];
    public $timestamps = false;

    public function pasien(): HasManyThrough
    {
        return $this->hasManyThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
}
