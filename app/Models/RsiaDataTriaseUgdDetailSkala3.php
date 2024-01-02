<?php

namespace App\Models;

use App\Models\RsiaMasterTriaseSkala3;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaDataTriaseUgdDetailSkala3 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala3';

    protected $fillable = [
        'no_rawat',
        'kode_skala3',
    ];

    public $timestamps = false;
    function skala3()
    {
        return $this->belongsTo(RsiaMasterTriaseSkala3::class, 'kode_skala3', 'kode_skala3');
    }
}
