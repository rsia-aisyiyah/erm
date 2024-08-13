<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class SkriningTb extends Model
{
    use HasFactory;
    protected $table = 'rsia_skrining_tb';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat'); //
    }
    function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik')
            ->select('*');
    }
    function pasien(): HasOneThrough
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis')
            ->select(['nm_pasien', 'pasien.no_rkm_medis', 'alamat', 'tgl_lahir', 'no_tlp', 'jk', 'kd_kec', 'kd_kab']);
    }
    function penjab(): HasOneThrough
    {
        return $this->hasOneThrough(Penjab::class, RegPeriksa::class, 'no_rawat', 'kd_pj', 'no_rawat', 'kd_pj')
            ->select(['penjab.kd_pj', 'png_jawab']);
    }
    function kamar(): HasOne
    {
        return $this->hasOne(KamarInap::class, 'no_rawat', 'no_rawat')->where('stts_pulang', '!=', 'Pindah Kamar')->select(['kd_kamar', 'no_rawat']);
    }
}
