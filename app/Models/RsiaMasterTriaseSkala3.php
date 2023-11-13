<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriaseSkala3 extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_skala3';

    function triase()
    {
        return $this->belongsTo(RsiaDataTriaseUgdDetailSkala3::class, 'kode_skala3', 'kode_skala3');
    }
    function pemeriksaan()
    {
        return $this->belongsTo(RsiaMasterTriasePemeriksaan::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }
}
