<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenNyeriNeonatus extends Model
{
    use HasFactory;
    protected $table = 'rsia_asesmen_nyeri_neonatal';
    protected $guarded = [];
    public $timestamps = false;

    
    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
    function regPeriksa(){
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function petugas(){
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

}
