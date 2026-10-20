<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPermintaanResepPulang extends Model
{
    use HasFactory;

    protected $table = 'detail_permintaan_resep_pulang';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }

    public function permintaan()
    {
        return $this->belongsTo(PermintaanResepPulang::class, 'no_permintaan', 'no_permintaan');
    }
}
