<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanRadiologi extends Model
{
    use HasFactory;
    protected $table = 'permintaan_radiologi';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokterRujuk()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }
    function periksaRadiologi()
    {
        return $this->belongsTo(PeriksaRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function hasilRadiologi()
    {
        return $this->hasOne(HasilRadiologi::class, 'no_rawat', 'no_rawat');
    }
}
