<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    function departement(): BelongsTo
    {
        return $this->belongsTo(Departemen::class, 'departemen', 'dep_id');
    }
}
