<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaOperasi extends Model
{
    use HasFactory;

    protected $table = 'rsia_operasi';
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

    public function operatorSatu()
    {
        return $this->belongsTo(Dokter::class, 'operator1', 'kd_dokter');
    }

    public function dokterAnestesi()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anestesi', 'kd_dokter');
    }

    public function dokterAnak()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anak', 'kd_dokter');
    }

    public function asistenOperatorSatu()
    {
        return $this->belongsTo(Petugas::class, 'asisten_operator1', 'nip');
    }

    public function asistenOperatorDua()
    {
        return $this->belongsTo(Petugas::class, 'asisten_operator2', 'nip');
    }

    public function asistenAnestesiPetugas()
    {
        return $this->belongsTo(Petugas::class, 'asisten_anestesi', 'nip');
    }

    public function onloopPetugas()
    {
        return $this->belongsTo(Petugas::class, 'onloop', 'nip');
    }

    public function bookingOperasi()
    {
        return $this->hasOne(BookingOperasi::class, 'no_rawat', 'no_rawat');
    }
}
