<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanStokObatPasien extends Model
{
    use HasFactory;

    protected $table = 'permintaan_stok_obat_pasien';
    protected $primaryKey = 'no_permintaan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaanStokObatPasien::class, 'no_permintaan', 'no_permintaan');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
