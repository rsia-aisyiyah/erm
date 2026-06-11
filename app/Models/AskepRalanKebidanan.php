<?php

namespace App\Models;


use App\Traits\AuditTrail;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskepRalanKebidanan extends Model
{
    use HasFactory, Compoships, AuditTrail;
    protected $table = 'penilaian_awal_keperawatan_kebidanan';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'no_rawat';
    protected $keyType = "string";
    public $incrementing = false;

    protected function getAuditKeys(): array
    {
        return [
            'no_rawat' => $this->no_rawat,
        ];
    }
    protected function getAuditModule(): string
    {
        return 'ASKEP_AWAL_RAWAT_JALAN_KANDUNGAN';
    }

    protected function getAuditNoRm(): ?string
    {
        return $this->regPeriksa?->no_rkm_medis;
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function semua()
    {
        return $this->with(['petugas', 'regPeriksa.pasien.riwayatPersalinan']);
    }
    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis')
            ->select('pasien.jk', 'tgl_lahir', 'nm_pasien', 'pasien.no_rkm_medis', 'agama');
    }
    public function riwayatPersalinan()
    {
        return $this->hasManyThrough(RiwayatPersalinan::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
}
