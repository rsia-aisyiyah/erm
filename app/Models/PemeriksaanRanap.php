<?php

namespace App\Models;

use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Models\RsiaLogSoap;
use App\Models\GrafikHarian;
use App\Traits\AuditTrail;
use App\Traits\HasCompositeKey;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemeriksaanRanap extends Model
{
    use HasFactory, Compoships, AuditTrail, HasCompositeKey;
    protected $table = 'pemeriksaan_ranap';
    public $timestamps = false;
    protected $fillable = ['suhu_tubuh', 'no_rawat', 'tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'tinggi', 'berat', 'spo2', 'kesadaran', 'gcs', 'keluhan', 'pemeriksaan', 'alergi', 'lingkar_perut', 'rtl', 'penilaian', 'instruksi', 'evaluasi', 'nip', 'o2'];
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
        return 'PEMERIKSAAN_RAWAT_INAP';
    }

    protected function getAuditNoRm(): ?string
    {
        return $this->regPeriksa?->no_rkm_medis;
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function grafikHarian()
    {
        return $this->hasMany(GrafikHarian::class, 'no_rawat', 'no_rawat');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    function verifikasi()
    {
        return $this->hasOne(RsiaVerifPemeriksaanRanap::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat']);
    }
    function log()
    {
        return $this->hasMany(RsiaLogSoap::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat']);
    }
    function sbar()
    {
        return $this->hasOne(RsiaGrafikHarian::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat'])
            ->where('sumber', 'SBAR')
            ->select('no_rawat', 'tgl_perawatan', 'jam_rawat', 'sumber', 'nip');
    }
    function adime()
    {
        return $this->hasOne(RsiaGrafikHarian::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat'])
            ->select('no_rawat', 'tgl_perawatan', 'jam_rawat')
            ->where('sumber', 'ADIME');
    }
    function kamarInap()
    {
        return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
    }


}
