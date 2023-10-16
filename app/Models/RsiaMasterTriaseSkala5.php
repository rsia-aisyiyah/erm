<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriaseSkala5 extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_skala5';

    function triase() {
        return $this->belongsTo(RsiaDataTriaseUgdDetailSkala5::class, 'kode_skala5', 'kode_skala5');
    }
}
