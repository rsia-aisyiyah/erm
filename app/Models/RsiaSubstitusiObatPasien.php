<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaSubstitusiObatPasien extends Model
{
    use HasFactory;

    protected $table = 'rsia_substitusi_obat_pasien';
    protected $guarded = [];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanStokObatPasien::class, 'no_permintaan', 'no_permintaan');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function barangAsal()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng_asal', 'kode_brng');
    }

    public function barangPengganti()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng_pengganti', 'kode_brng');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}

