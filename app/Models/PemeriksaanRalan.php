<?php

namespace App\Models;

use App\Traits\AuditTrail;
use App\Traits\HasCompositeKey;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemeriksaanRalan extends Model
{
    use HasFactory, Compoships, AuditTrail, HasCompositeKey;
    protected $table = 'pemeriksaan_ralan';
    public $timestamps = false;
    public $guarded = [];


    protected $primaryKey = [
        'no_rawat',
        'tgl_perawatan',
        'jam_rawat',
        'nip'
    ];
    public $incrementing = false;

    protected function getAuditKeys(): array
    {
        return [
            'no_rawat' => $this->no_rawat,
            'tgl_perawatan' => $this->tgl_perawatan,
            'jam_rawat' => $this->jam_rawat,
        ];
    }
    protected function getAuditModule(): string
    {
        return 'PEMERIKSAAN_RAWAT_JALAN';
    }

    protected function getAuditNoRm(): ?string
    {
        return $this->regPeriksa?->no_rkm_medis;
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    function grafik()
    {
        return $this->hasMany(GrafikHarian::class, 'no_rawat', 'no_rawat');
    }
    function log()
    {
        return $this->hasMany(RsiaLogSoap::class, 'no_rawat', 'no_rawat');
    }


}
