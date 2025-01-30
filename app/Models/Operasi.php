<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\Petugas;
use App\Models\PaketOperasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operasi extends Model
{
    use HasFactory;
    protected $table = 'operasi';

    function paketOperasi()
    {
        return $this->belongsTo(PaketOperasi::class, 'kode_paket', 'kode_paket');
    }
    function op1()
    {
        return $this->belongsTo(Dokter::class, 'operator1', 'kd_dokter');
    }
    function op2()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'operator2');
    }
    function op3()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'operator2');
    }
    function asistenOp1()
    {
        return $this->belongsTo(Petugas::class, 'asisten_operator1', 'nip');
    }
    function asistenOp2()
    {
        return $this->belongsTo(Petugas::class, 'asisten_operator2', 'nip');
    }
    function asistenOp3()
    {
        return $this->belongsTo(Petugas::class, 'asisten_operator3', 'nip');
    }
    function omloop()
    {
        return $this->belongsTo(Petugas::class, 'omloop', 'nip');
    }
    function laporan(){
        return $this->hasOne(LaporanOperasi::class, 'no_rawat', 'no_rawat');
    }
}
