<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDataTriaseUgdDetailSkala5 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala5';

    protected $fillable = [
        'no_rawat',
        'kode_skala5',
    ];

    public $timestamps = false;
}
