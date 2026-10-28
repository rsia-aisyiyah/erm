<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPermintaanStokObatPasien extends Model
{
    use HasFactory;

    protected $table = 'detail_permintaan_stok_obat_pasien';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanStokObatPasien::class, 'no_permintaan', 'no_permintaan');
    }

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
