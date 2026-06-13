<?php

namespace App\Models;

use App\Traits\AuditTrail;
use App\Traits\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MasalahAskepRalanAnak extends Model
{
    use HasFactory, HasCompositeKey, AuditTrail;
    protected $table = 'penilaian_awal_keperawatan_ralan_bayi_masalah';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = ['no_rawat', 'kode_masalah'];
    public $incrementing = false;


    protected function getAuditKeys(): array
    {
        return [
            'no_rawat' => $this->no_rawat,
            'kode_masalah' => $this->kode_masalah
        ];
    }
    protected function getAuditNoRm(): string
    {
        return $this->regPeriksa->no_rkm_medis;
    }
    protected function getAuditModule(): string
    {
        return 'MASALAH_ASKEP_RALAN_ANAK';
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
}
