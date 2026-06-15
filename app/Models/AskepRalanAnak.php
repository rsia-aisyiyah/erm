<?php

namespace App\Models;

use App\Traits\AuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskepRalanAnak extends Model
{
    use HasFactory, AuditTrail;

    protected $table = 'penilaian_awal_keperawatan_ralan_bayi';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'no_rawat';
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
        return 'ASESMEN_RAWAT_JALAN_ANAK_BAYI';
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    public function petugas()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }
    public function masalah()
    {
        return $this->hasMany(MasalahAskepRalanAnak::class, 'no_rawat', 'no_rawat')
            ->join('master_masalah_keperawatan_anak', 'master_masalah_keperawatan_anak.kode_masalah', '=', 'penilaian_awal_keperawatan_ralan_bayi_masalah.kode_masalah');

    }
    public function rencanaMasalah()
    {
        return $this->hasMany(RencanaAskepRalanAnak::class, 'no_rawat', 'no_rawat')
            ->join('master_rencana_keperawatan_anak', 'master_rencana_keperawatan_anak.kode_rencana', '=', 'penilaian_awal_keperawatan_ralan_rencana_anak.kode_rencana');

    }
    public function riwayatImunisasi()
    {
        return $this->hasManyThrough(RiwayatImunisasi::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis')
            ->join('master_imunisasi', 'master_imunisasi.kode_imunisasi', '=', 'riwayat_imunisasi.kode_imunisasi')
            ->select('riwayat_imunisasi.*', 'master_imunisasi.*');
    }
    public function masterMasalah()
    {
        return $this->hasManyThrough(
            MasalahAskepRalanAnak::class,
            MasterMasalahKeperawatan::class,
            'kode_masalah',
            'no_rawat',
            'kode_masalah',
            'no_rawat'
        );
    }
}
