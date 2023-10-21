<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Penjab;
use App\Models\Upload;
use App\Models\Operasi;
use App\Models\KamarInap;
use App\Models\ResepObat;
use App\Models\Poliklinik;
use App\Models\BridgingSep;
use App\Models\RanapGabung;
use App\Models\BridgingSPRI;
use App\Models\AskepRalanAnak;
use App\Models\DiagnosaPasien;
use App\Models\LaporanOperasi;
use App\Models\ProsedurPasien;
use App\Models\CatatanPerawatan;
use App\Models\PemeriksaanRalan;
use App\Models\ResumePasienRanap;
use App\Models\SuratKontrolUlang;
use App\Models\AskepRanapNeonatus;
use App\Models\RsiaGeneralConsent;
use App\Models\AskepRalanKebidanan;
use App\Models\AskepRanapKandungan;
use App\Models\DetailPemberianObat;
use App\Models\DetailPemeriksaanLab;
use Illuminate\Database\Eloquent\Model;
use App\Models\PenilaianMedisRalanKandungan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegPeriksa extends Model
{
    use HasFactory;
    protected $table = 'reg_periksa';
    public $timestamps = false;

    protected $fillable = ['no_reg', 'no_rkm_medis', 'no_rawat', 'tgl_registrasi', 'jam_reg', 'kd_dokter', 'no_rkm_medis', 'kd_poli', 'p_jawab', 'almt_pj', 'hubunganpj', 'biaya_reg', 'stts', 'stts_daftar', 'stts_lanjut', 'kd_pj', 'umurdaftar', 'sttsumur', 'status_bayar', 'status_poli'];

    public function suratKontrol()
    {
        return $this->hasOne(SuratKontrolUlang::class, 'no_rawat', 'no_rawat');
    }
    public function sep()
    {
        return $this->hasOne(BridgingSep::class, 'no_rawat', 'no_rawat');
    }
    public function ranapGabung()
    {
        return $this->belongsTo(RanapGabung::class, 'no_rawat', 'no_rawat');
    }
    public function bayiGabung()
    {
        return $this->belongsTo(RanapGabung::class, 'no_rawat', 'no_rawat2');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
    public function upload()
    {
        return $this->hasMany(Upload::class, 'no_rawat', 'no_rawat');
    }
    public function kamarInap()
    {
        return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    public function kamarPulang()
    {
        return $this->hasOne(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function pemeriksaanRalan()
    {
        return $this->hasMany(PemeriksaanRalan::class, 'no_rawat', 'no_rawat');
    }
    public function pemeriksaanRanap()
    {
        return $this->hasMany(PemeriksaanRanap::class, 'no_rawat', 'no_rawat');
    }
    public function catatanPerawatan()
    {
        return $this->hasOne(CatatanPerawatan::class, 'no_rawat', 'no_rawat');
    }
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli', 'kd_poli');
    }
    public function penjab()
    {
        return $this->belongsTo(Penjab::class, 'kd_pj', 'kd_pj');
    }
    public function diagnosaPasien()
    {
        return $this->hasMany(DiagnosaPasien::class, 'no_rawat', 'no_rawat');
    }
    public function detailPemberianObat()
    {
        return $this->hasMany(DetailPemberianObat::class, 'no_rawat', 'no_rawat');
    }
    public function detailPemeriksaanLab()
    {
        return $this->hasMany(DetailPemeriksaanLab::class, 'no_rawat', 'no_rawat');
    }
    public function prosedurPasien()
    {
        return $this->hasMany(ProsedurPasien::class, 'no_rawat', 'no_rawat');
    }
    public function medisRalanKandungan()
    {
        return $this->hasMany(PenilaianMedisRalanKandungan::class, 'no_rawat', 'no_rawat');
    }
    public function resepObat()
    {
        return $this->hasMany(ResepObat::class, 'no_rawat', 'no_rawat');
    }
    public function generalConsent()
    {
        return $this->hasOne(RsiaGeneralConsent::class, 'no_rawat', 'no_rawat');
    }
    public function askepRalanKebidanan()
    {
        return $this->hasMany(AskepRalanKebidanan::class, 'no_rawat', 'no_rawat');
    }
    public function askepRalanAnak()
    {
        return $this->hasMany(AskepRalanAnak::class, 'no_rawat', 'no_rawat');
    }
    public function operasi()
    {
        return $this->hasOne(Operasi::class, 'no_rawat', 'no_rawat');
    }
    function laporanOperasi()
    {
        return $this->hasOne(LaporanOperasi::class, 'no_rawat', 'no_rawat');
    }
    function perintahInap()
    {
        return $this->hasOne(BridgingSPRI::class, 'no_rawat', 'no_rawat');
    }
    function asmedRajalKandungan()
    {
        return $this->hasMany(AsesmenMedisRajalKandungan::class, 'no_rawat', 'no_rawat');
    }
    function asmedRanapKandungan()
    {
        return $this->hasOne(AsesmenMedisRanapKandungan::class, 'no_rawat', 'no_rawat');
    }
    function asmedRanapAnak()
    {
        return $this->hasOne(AsesmenMedisAnak::class, 'no_rawat', 'no_rawat');
    }
    function askepRanapAnak()
    {
        return $this->hasOne(AskepRanapAnak::class, 'no_rawat', 'no_rawat');
    }
    function askepRanapNeonatus()
    {
        return $this->hasOne(AskepRanapNeonatus::class, 'no_rawat', 'no_rawat');
    }
    function askepRanapKandungan()
    {
        return $this->hasOne(AskepRanapKandungan::class, 'no_rawat', 'no_rawat');
    }
    function resumeMedis()
    {
        return $this->hasOne(ResumePasienRanap::class, 'no_rawat', 'no_rawat');
    }
    function permintaanRadiologi()
    {
        return $this->hasMany(PermintaanRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function periksaRadiologi()
    {
        return $this->hasMany(PeriksaRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function hasilRadiologi()
    {
        return $this->hasMany(HasilRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function gambarRadiologi()
    {
        return $this->hasMany(GambarRadiologi::class, 'no_rawat', 'no_rawat');
    }
}
