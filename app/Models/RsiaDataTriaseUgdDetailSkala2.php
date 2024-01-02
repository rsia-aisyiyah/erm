<?php

namespace App\Models;

use App\Models\RsiaMasterTriaseSkala2;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaDataTriaseUgdDetailSkala2 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala2';

    protected $fillable = [
        'no_rawat',
        'kode_skala2',
    ];

    public $timestamps = false;
    function skala2()
    {
        return $this->belongsTo(RsiaMasterTriaseSkala2::class, 'kode_skala2', 'kode_skala2');
    }
}
