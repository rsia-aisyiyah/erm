<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriaseSkala1 extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_skala1';

    function triase() {
        return $this->belongsTo(RsiaDataTriaseUgdDetailSkala1::class, 'kode_skala1', 'kode_skala1');
    }
}
