<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskepRalanKebidanan extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_kebidanan';

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    public function regPeriksa()
    {
        return $this->hasOne(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function semua()
    {
        return $this->with(['petugas', 'regPeriksa.pasien.riwayatPersalinan']);
    }
}
