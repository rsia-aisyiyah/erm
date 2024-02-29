<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaHasilKritis extends Model
{
    use HasFactory;
    protected $table = 'rsia_hasil_kritis';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas', 'nip');
    }
    function petugasRuang()
    {
        return $this->belongsTo(Petugas::class, 'petugas_ruang', 'nip');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter', 'kd_dokter');
    }
}
