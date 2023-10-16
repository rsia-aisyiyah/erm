<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDataTriaseUgdDetailSkala3 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala3';

    protected $fillable = [
        'no_rawat',
        'kode_skala3',
    ];

    public $timestamps = false;
}
