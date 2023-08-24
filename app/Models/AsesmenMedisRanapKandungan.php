<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenMedisRanapKandungan extends Model
{
    use HasFactory;
    protected $table = 'penilaian_medis_ranap_kandungan';
    protected $fillable = ['no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran', 'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi', 'tht', 'thoraks', 'jantung', 'paru', 'abdomen', 'genital', 'ekstremitas', 'kulit', 'ket_fisik', 'tfu', 'tbj', 'his', 'kontraksi', 'djj', 'inspeksi', 'inspekulo', 'vt', 'rt', 'ultra', 'kardio', 'lab', 'diagnosis', 'tata', 'edukasi'];
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
