<?php

namespace App\Models;

use App\Traits\AuditTrail;
use App\Traits\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPersalinan extends Model
{
    use HasFactory, HasCompositeKey, AuditTrail;
    protected $table = 'riwayat_persalinan_pasien';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = ['no_rkm_medis', 'tgl_thn'];
    public $incrementing = false;

    protected function getAuditKeys(): array
    {
        return [
            'no_rkm_medis' => $this->no_rkm_medis,
            'tgl_thn' => $this->tgl_thn,
        ];
    }
    protected function getAuditModule(): string
    {
        return 'RIWAYAT_PERSALINAN_PASIEN';
    }
    protected function getAuditNoRm(): ?string
    {
        return $this->no_rkm_medis;
    }
}
