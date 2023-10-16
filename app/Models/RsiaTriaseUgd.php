<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaTriaseUgd extends Model
{
    use HasFactory;

    protected $table = 'rsia_triase_ugd';

    public $timestamps = false;

    // fillable
    // no_rawat, tgl_kunjungan
    protected $fillable = [
        'no_rawat',
        'tgl_kunjungan'
    ];

    protected $casts = [
        'tgl_kunjungan' => 'datetime'
    ];
}
