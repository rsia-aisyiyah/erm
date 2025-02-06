<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';

    public function periksaLab()
    {
        return $this->hasMany(PeriksaLab::class, 'nip', 'nip');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'nip', 'kd_dokter');
    }
    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'nip', 'nik')
        ->select('nik', 'nama', 'departemen');
    }
}
