<?php

namespace App\Models;

use App\Models\Penjab;
use App\Models\Upload;
use App\Models\Instansi;
use App\Models\Propinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\CacatFisik;
use App\Models\RegPeriksa;
use App\Models\SukuBangsa;
use App\Models\BridgingSep;
use App\Models\BahasaPasien;
use App\Models\BridgingSPRI;
use App\Models\RsiaKetPasien;
use App\Models\AskepRalanAnak;
use App\Models\RiwayatImunisasi;
use App\Models\RiwayatPersalinan;
use App\Models\AskepRalanKebidanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
    public function penjab()
    {
        return $this->belongsTo(Penjab::class, 'kd_pj', 'kd_pj');
    }
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'perusahaan_pasien', 'kode_perusahaan');
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
    function kel()
    {
        return $this->belongsTo(Kelurahan::class, 'kd_kel', 'kd_kel');
    }
    function kec()
    {
        return $this->belongsTo(Kecamatan::class, 'kd_kec', 'kd_kec');
    }
    function kab()
    {
        return $this->belongsTo(Kabupaten::class, 'kd_kab', 'kd_kab');
    }
    function prop()
    {
        return $this->belongsTo(Propinsi::class, 'kd_prop', 'kd_prop');
    }
    function ketPasien()
    {
        return $this->hasOne(RsiaKetPasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
    function askepRalanAnak(): HasManyThrough
    {
        return $this->hasManyThrough(
            AskepRalanAnak::class,
            RegPeriksa::class,
            'no_rkm_medis',
            'no_rawat',
            'no_rkm_medis',
            'no_rawat'
        );
    }

    function askepRalanKebidanan(): HasManyThrough
    {
        return $this->hasManyThrough(
            AskepRalanKebidanan::class,
            RegPeriksa::class,
            'no_rkm_medis',
            'no_rawat',
            'no_rkm_medis',
            'no_rawat'
        );
    }
    function sukuBangsa(): BelongsTo
    {
        return $this->belongsTo(SukuBangsa::class, 'suku_bangsa', 'id');
    }
}
