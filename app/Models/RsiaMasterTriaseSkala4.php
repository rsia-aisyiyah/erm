<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriaseSkala4 extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_skala4';

    function triase()
    {
        return $this->belongsTo(RsiaDataTriaseUgdDetailSkala4::class, 'kode_skala4', 'kode_skala4');
    }
    function pemeriksaan()
    {
        return $this->belongsTo(RsiaMasterTriasePemeriksaan::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }
}
