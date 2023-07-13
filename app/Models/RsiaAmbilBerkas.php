<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaAmbilBerkas extends Model
{
    use HasFactory;
    protected $table = 'rsia_ambil_berkas';
    protected $fillable = ['no_rawat', 'no_rkm_medis', 'waktu', 'jam_praktek'];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
};
