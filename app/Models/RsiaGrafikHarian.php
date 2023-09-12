<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaGrafikHarian extends Model
{
    use HasFactory;

    protected $table = 'rsia_grafik_harian';
    public $timestamps = false;
    public $guarded = [];

    // protected $fillable = [
    //     'no_rawat','tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 
    //     'respirasi', 'spo2', 'o2', 'gcs', 'kesadaran', 'sumber', 'nip',
    // ];
}
