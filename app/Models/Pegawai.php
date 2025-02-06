<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = ['nik'];

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'nip', 'nik');
    }
    public function generalConsent()
    {
        return $this->hasOne(RsiaGeneralConsent::class, 'nik', 'nik');
    }
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'kd_dokter', 'nik');
    }
    function sidikjari()
    {
        return $this->hasOne(SidikJari::class, 'id', 'id');
    }

    function departemen()
    {
        return $this->hasOne(Departemen::class, 'dep_id', 'departemen');
    }
}
