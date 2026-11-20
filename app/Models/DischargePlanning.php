<?php

namespace App\Models;

use App\Models\Pasien;
use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Traits\AuditTrail;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DischargePlanning extends Model
{
    use HasFactory, Compoships, AuditTrail;

    protected $table = 'rsia_discharge_planning';

    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'no_rawat';
    protected $keyType = 'string';
    public $incrementing = false;

    protected function getAuditKeys(): array
    {
        return ['no_rawat' => $this->no_rawat];
    }
    protected function getAuditNoRm(): ?string
    {
        return $this->pasien->no_rkm_medis;
    }
    protected function getAuditModule(): ?string
    {
        return 'DISCHARGE_PLANNING';
    }

    protected function getAuditTable(): string
    {
        return 'rsia_discharge_planning';
    }

    function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

}