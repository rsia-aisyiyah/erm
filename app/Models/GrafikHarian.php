<?php

namespace App\Models;

use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Traits\AuditTrail;
use App\Traits\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrafikHarian extends Model
{
    use HasFactory, HasCompositeKey, AuditTrail;
    protected $table = 'rsia_grafik_harian';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = ['no_rawat', 'tgl_perawatan', 'jam_rawat'];
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
        return 'GRAFIK_HARIAN';
    }
    protected function getAuditNoRm(): string
    {
        return $this->regPeriksa?->no_rkm_medis;
    }



    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

    public function pegawai()
    {
        // pegawai nik
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    public function verifikasi()
    {
        return $this->hasOne(RsiaVerifPemeriksaanRanap::class, 'no_rawat', 'no_rawat');
    }
}
