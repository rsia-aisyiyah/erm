<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\RsiaGrafikHarian;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaKonsulSbar extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_konsul_sbar';
    protected $guarded = [];
    public $timestamps = false;

    function sbar(){
        return $this->belongsTo(RsiaGrafikHarian::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat']);
    }
    function dokterSbar(){
        return $this->belongsTo(Dokter::class, 'dokter', 'kd_dokter')
        ->select(['kd_dokter', 'nm_dokter']);
    }
}
