<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaRencanaKontrolRalan extends Model
{
    use HasFactory;

    protected $table = 'rsia_rencana_kontrol_ralan';
    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli', 'kd_poli');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
}
