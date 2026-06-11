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
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat')
            ->select('no_rawat', 'no_rkm_medis', 'kd_poli', 'kd_dokter', 'tgl_registrasi', 'jam_reg');
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
    function dokterPj()
    {
        return $this->belongsTo(Dokter::class, 'dokter_pj', 'kd_dokter');
    }
    function kamar()
    {
        return $this->hasOneThrough(Kamar::class, KamarInap::class, 'no_rawat', 'kd_kamar', 'no_rawat', 'kd_kamar')
            ->join('bangsal', 'kamar.kd_bangsal', '=', 'bangsal.kd_bangsal')
            ->select('kamar.*', 'bangsal.nm_bangsal');
    }
}
