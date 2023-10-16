<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDataTriaseUgdDetailSkala2 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala2';

    protected $fillable = [
        'no_rawat',
        'kode_skala2',
    ];

    public $timestamps = false;
}
