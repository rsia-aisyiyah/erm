<?php

namespace App\Models;

use App\Models\Upload;
use App\Models\BridgingSep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    public function regPeriksa()
    {
        return $this->hasMany(
            RegPeriksa::class,
            'no_rkm_medis',
            'no_rkm_medis'
        );
    }
    public function upload()
    {
        return $this->hasMany(Upload::class, 'no_rkm_medis', 'no_rkm_medis');
    }
    public function riwayatPersalinan()
    {
        return $this->hasMany(RiwayatPersalinan::class, 'no_rkm_medis', 'no_rkm_medis');
    }
    public function riwayatImunisasi()
    {
        return $this->hasMany(RiwayatImunisasi::class, 'no_rkm_medis', 'no_rkm_medis');
    }
    function sep()
    {
        return $this->hasMany(BridgingSep::class, 'no_kartu', 'no_peserta');
    }
    function spri()
    {
        return $this->hasOne(BridgingSPRI::class, 'no_kartu', 'no_peserta');
    }
    function bahasa()
    {
        return $this->belongsTo(BahasaPasien::class, 'bahasa_pasien', 'id');
    }
    function cacat()
    {
        return $this->belongsTo(CacatFisik::class, 'cacat_fisik', 'id');
    }
    function ketPasien()
    {
        return $this->hasOne(RsiaKetPasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
}
