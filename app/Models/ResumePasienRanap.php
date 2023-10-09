<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePasienRanap extends Model
{
    use HasFactory;
    protected $table = 'resume_pasien_ranap';
    protected $guarded = [];
    public $timestamps = false;

    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    function kamarInap()
    {
        return $this->belongsTo(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function bayiGabung()
    {
        return $this->belongsTo(RanapGabung::class, 'no_rawat', 'no_rawat2');
    }
}
