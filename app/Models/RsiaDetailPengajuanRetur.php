<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDetailPengajuanRetur extends Model
{
    use HasFactory;

    protected $table = 'rsia_detail_pengajuan_retur';

    protected $guarded = [];

    public function pengajuan()
    {
        return $this->belongsTo(RsiaPengajuanRetur::class, 'no_pengajuan', 'no_pengajuan');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'kode_brng', 'kode_brng');
    }

    public function satuan()
    {
        return $this->belongsTo(KodeSatuan::class, 'kode_sat', 'kode_sat');
    }
}
