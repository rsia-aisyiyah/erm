<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriaseSkala2 extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_skala2';

    function triase() {
        return $this->belongsTo(RsiaDataTriaseUgdDetailSkala2::class, 'kode_skala2', 'kode_skala2');
    }
}
