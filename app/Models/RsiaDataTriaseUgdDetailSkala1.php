<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDataTriaseUgdDetailSkala1 extends Model
{
    use HasFactory;

    protected $table = 'rsia_data_triase_ugddetail_skala1';

    protected $fillable = [
        'no_rawat',
        'kode_skala1',
    ];

    // timestamp
    public $timestamps = false;

    // getTableName() method
    public static function getTableName()
    {
        return (new static)->getTable();
    }
}
