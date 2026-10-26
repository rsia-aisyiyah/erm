<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaDetailReturStokUdd extends Model
{
    use HasFactory;

    protected $table = 'rsia_detail_retur_stok_udd';

    protected $guarded = [];

    public function returHeader()
    {
        return $this->belongsTo(RsiaReturStokUdd::class, 'no_retur_udd', 'no_retur_udd');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'kode_brng', 'kode_brng');
    }
}
