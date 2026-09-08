<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\AuditTrail;

class RsiaPersetujuanAnestesi extends Model
{
    use HasFactory, AuditTrail;

    protected $table = 'rsia_persetujuan_anestesi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $guarded = ['id'];

    protected function getAuditKeys(): array
    {
        return [
            'id' => $this->id,
        ];
    }
    protected function getAuditModule(): string
    {
        return 'PERSETUJUAN_ANESTESI_TINDAKAN_MEDIS_REGIONAL_ANESTESI';
    }

 protected function getAuditNoRm(): ?string
    {
        return $this->regPeriksa?->no_rkm_medis;
    }


    public function regPeriksa(): BelongsTo
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function dokterAnestesi(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter_anestesi', 'kd_dokter');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'nip_petugas', 'nik');
    }
}
