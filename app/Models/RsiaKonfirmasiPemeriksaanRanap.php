<?php

namespace App\Models;

use App\Traits\HasCompositeKey;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaKonfirmasiPemeriksaanRanap extends Model
{
    use HasFactory, Compoships, HasCompositeKey;
    protected $table = 'rsia_konfirmasi_pemeriksaan_ranap';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = [
        'no_rawat',
        'tgl_perawatan',
        'jam_rawat'
    ];

}
