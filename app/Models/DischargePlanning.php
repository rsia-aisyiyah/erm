<?php

namespace App\Models;

use App\Models\Pasien;
use App\Models\Petugas;
use App\Models\RegPeriksa;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DischargePlanning extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_discharge_planning';

    protected $guarded = [];
    public $timestamps = false;

    function pasien(){
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
    function regPeriksa(){
       return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function petugas(){
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    
}
