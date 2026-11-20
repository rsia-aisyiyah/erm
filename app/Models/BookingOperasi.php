<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOperasi extends Model
{
    use HasFactory;

    protected $table = 'booking_operasi';
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function paketOperasi()
    {
        return $this->belongsTo(PaketOperasi::class, 'kode_paket', 'kode_paket');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    public function laporanOperasi()
    {
        return $this->hasOne(RsiaOperasiSafe::class, 'no_rawat', 'no_rawat');
    }

    public function laporanOperasiSafe()
    {
        return $this->hasOne(RsiaOperasiSafe::class, 'no_rawat', 'no_rawat');
    }

    public function laporanOperasiKhanza()
    {
        return $this->hasOne(LaporanOperasi::class, 'no_rawat', 'no_rawat');
    }

    public function operasiKhanza()
    {
        return $this->hasOne(Operasi::class, 'no_rawat', 'no_rawat');
    }
}

