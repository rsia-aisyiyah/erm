<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenMedisRajalKandungan extends Model
{
    use HasFactory;
    protected  $table = 'penilaian_medis_ralan_kandungan';
    protected $guarded = [];
    public $timestamps = false;
    protected $fillable
    = ['no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran', 'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi', 'tht', 'thoraks', 'abdomen', 'genital', 'ekstremitas', 'kulit', 'ket_fisik', 'tfu', 'tbj', 'his', 'kontraksi', 'djj', 'inspeksi', 'inspekulo', 'vt', 'rt', 'ultra', 'kardio', 'lab', 'diagnosis', 'tata', 'konsul'];

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
