<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaReturStokUdd extends Model
{
    use HasFactory;

    protected $table = 'rsia_retur_stok_udd';
    protected $primaryKey = 'no_retur_udd';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(RsiaDetailReturStokUdd::class, 'no_retur_udd', 'no_retur_udd');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function bangsal()
    {
        return $this->belongsTo(Bangsal::class, 'kd_bangsal', 'kd_bangsal');
    }

    public function pegawaiRuangan()
    {
        return $this->belongsTo(Pegawai::class, 'petugas_ruangan', 'nik');
    }

    public function pegawaiFarmasi()
    {
        return $this->belongsTo(Pegawai::class, 'petugas_farmasi', 'nik');
    }
}
