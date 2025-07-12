<?php

namespace App\Models;

use App\Models\Pasien;
use App\Models\RegPeriksa;
use App\Models\RencanaKontrol;
use App\Models\BridgingRujukanBpjs;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BridgingSep extends Model
{
    use HasFactory, Compoships;
    protected $table = 'bridging_sep';

    protected $primaryKey = 'no_sep';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $with = ['regPeriksa.poliklinik'];
    public function scopeBetweenTanggal(Builder $query, $start, $end)
    {
        return $query->whereBetween('tglsep', [$start, $end]);
    }

    public function scopeTahun(Builder $query, $tahun)
    {
        return $query->whereYear('tglsep', $tahun);
    }

    public function scopeBulan(Builder $query, $tahun, $bulan)
    {
        return $query->whereYear('tglsep', $tahun)
            ->whereMonth('tglsep', $bulan);
    }

    public function scopeWhereNoRawat(Builder $query, $no_rawat)
    {
        return $query->where('no_rawat', $no_rawat);
    }


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
        return $this->belongsTo(Pasien::class, 'no_kartu', 'no_peserta')
            ->selec(['no_kartu', 'no_rkm_medis', 'nm_pasien']);
    }
    public function spri()
    {
        return $this->hasOne(BridgingSPRI::class, 'no_kartu', 'no_kartu');
    }


    public function dokter()
    {
        return $this->belongsTo(MappingDokterDpjpVlcaim::class, 'kddpjp', 'kd_dokter_bpjs');
    }
}
