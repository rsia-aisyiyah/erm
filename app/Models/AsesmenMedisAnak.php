<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenMedisAnak extends Model
{
    use HasFactory;
    protected $table = 'penilaian_medis_ranap';
    protected $fillable = ['no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran', 'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi', 'tht', 'thoraks', 'jantung', 'paru', 'abdomen', 'genital', 'ekstremitas', 'kulit', 'ket_fisik', 'ket_lokalis', 'lab', 'rad', 'penunjang', 'diagnosis', 'tata', 'edukasi'];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
}
