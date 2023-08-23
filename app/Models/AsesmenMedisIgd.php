<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenMedisIgd extends Model
{
    use HasFactory;
    protected $table = 'penilaian_medis_igd';
    protected $fillable =
    ['no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran', 'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi', 'thoraks', 'leher', 'genital', 'ekstremitas', 'ket_fisik', 'ket_lokalis', 'lab', 'rad', 'ekg', 'diagnosis', 'tata'];
    public $timestamps = false;
    protected $guarded = [];

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
