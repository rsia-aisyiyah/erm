<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDataTriaseUgdDetailSkala4 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala4';

    protected $fillable = [
        'no_rawat',
        'kode_skala4',
    ];

    public $timestamps = false;
}
