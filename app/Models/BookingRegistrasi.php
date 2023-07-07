<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRegistrasi extends Model
{
    use HasFactory;
    protected $table = 'booking_registrasi';
    protected $fillable = ['tanggal_booking', 'jam_booking', 'no_rkm_medis', 'tanggal_periksa', 'kd_dokter', 'kd_poli', 'no_reg', 'kd_pj', 'limit_reg', 'waktu_kunjungan', 'status'];
    public $timestamps = false;

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
}
