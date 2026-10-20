<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPengajuanRetur extends Model
{
    use HasFactory;

    protected $table = 'rsia_pengajuan_retur';
    protected $primaryKey = 'no_pengajuan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(RsiaDetailPengajuanRetur::class, 'no_pengajuan', 'no_pengajuan');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function pegawaiPengaju()
    {
        return $this->belongsTo(Pegawai::class, 'petugas_pengaju', 'nik');
    }

    public function pegawaiValidasi()
    {
        return $this->belongsTo(Pegawai::class, 'petugas_validasi', 'nik');
    }

    public function bangsal()
    {
        return $this->belongsTo(Bangsal::class, 'kd_bangsal', 'kd_bangsal');
    }

    public function returJual()
    {
        return $this->belongsTo(ReturJual::class, 'no_retur_jual', 'no_retur_jual');
    }
}
