<?php

namespace App\Models;

use App\Models\Pasien;
use App\Models\RegPeriksa;
use App\Models\RencanaKontrol;
use App\Models\BridgingRujukanBpjs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BridgingSep extends Model
{
    use HasFactory;
    protected $table = 'bridging_sep';

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function suratKontrol()
    {
        return $this->hasOne(RencanaKontrol::class, 'no_sep', 'no_sep');
    }
    public function rujukanKeluar()
    {
        return $this->hasOne(BridgingRujukanBpjs::class, 'no_sep', 'no_sep');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_peserta', 'no_kartu');
    }
    public function spri()
    {
        return $this->hasOne(BridgingSPRI::class, 'no_kartu', 'no_kartu');
    }
}
