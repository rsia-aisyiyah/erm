<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskepRanapKandungan extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_kebidanan_ranap';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function pengkaji1()
    {
        return $this->belongsTo(Petugas::class, 'nip1', 'nip');
    }
    function pengkaji2()
    {
        return $this->belongsTo(Petugas::class, 'nip2', 'nip');
    }
}
