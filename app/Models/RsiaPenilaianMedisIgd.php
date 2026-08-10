<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPenilaianMedisIgd extends Model
{
    use HasFactory;

    protected $table = 'rsia_penilaian_medis_igd';
    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function penilaianMedisIgd()
    {
        return $this->belongsTo(AsesmenMedisIgd::class, 'no_rawat', 'no_rawat');
    }

    public function dpjp()
    {
        return $this->belongsTo(Dokter::class, 'ranap_dpjp', 'kd_dokter');
    }
}
