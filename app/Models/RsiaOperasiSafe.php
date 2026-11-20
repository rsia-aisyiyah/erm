<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaOperasiSafe extends Model
{
    use HasFactory;

    protected $table = 'rsia_operasi_safe';

    protected $primaryKey = 'no_rawat';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function bookingOperasi()
    {
        return $this->belongsTo(BookingOperasi::class, 'no_rawat', 'no_rawat');
    }

    public function detailPaket()
    {
        return $this->belongsTo(PaketOperasi::class, 'kode_paket', 'kode_paket')->select('kode_paket', 'nm_perawatan');
    }

    public function paketOperasi()
    {
        return $this->belongsTo(PaketOperasi::class, 'kode_paket', 'kode_paket');
    }

    public function detailOperator1()
    {
        return $this->belongsTo(Dokter::class, 'operator1', 'kd_dokter')->select('kd_dokter', 'nm_dokter')->where('kd_dokter', '<>', '-');
    }

    public function operatorSatu()
    {
        return $this->belongsTo(Dokter::class, 'operator1', 'kd_dokter');
    }

    public function detailAsistenOperator1()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_operator1', 'nik')->select('id', 'nik', 'nama')->where('nik', '<>', '-');
    }

    public function asistenOperatorSatu()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_operator1', 'nik');
    }

    public function detailAsistenOperator2()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_operator2', 'nik')->select('id', 'nik', 'nama')->where('nik', '<>', '-');
    }

    public function asistenOperatorDua()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_operator2', 'nik');
    }

    public function detailDokterAnak()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anak', 'kd_dokter')->select('kd_dokter', 'nm_dokter')->where('kd_dokter', '<>', '-');
    }

    public function dokterAnak()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anak', 'kd_dokter');
    }

    public function detailDokterAnestesi()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anestesi', 'kd_dokter')->select('kd_dokter', 'nm_dokter')->where('kd_dokter', '<>', '-');
    }

    public function dokterAnestesi()
    {
        return $this->belongsTo(Dokter::class, 'dokter_anestesi', 'kd_dokter');
    }

    public function detailAsistenAnestesi()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_anestesi', 'nik')->select('id', 'nik', 'nama')->where('nik', '<>', '-');
    }

    public function asistenAnestesiPetugas()
    {
        return $this->belongsTo(Pegawai::class, 'asisten_anestesi', 'nik');
    }

    public function detailOnloop()
    {
        return $this->belongsTo(Pegawai::class, 'onloop', 'nik')->select('id', 'nik', 'nama')->where('nik', '<>', '-');
    }

    public function onloopPetugas()
    {
        return $this->belongsTo(Pegawai::class, 'onloop', 'nik');
    }

    public function laporanKhanza()
    {
        return $this->hasOne(LaporanOperasi::class, 'no_rawat', 'no_rawat');
    }
}
