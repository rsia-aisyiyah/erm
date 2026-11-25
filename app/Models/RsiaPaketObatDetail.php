<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPaketObatDetail extends Model
{
    use HasFactory;

    protected $table = 'rsia_paket_obat_detail';

    public $timestamps = false;

    protected $guarded = [];

    public function paket()
    {
        return $this->belongsTo(RsiaPaketObat::class, 'paket_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
