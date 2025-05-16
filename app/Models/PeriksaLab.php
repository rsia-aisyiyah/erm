<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use SebastianBergmann\Template\Template;

class PeriksaLab extends Model
{
    use HasFactory, Compoships;
    protected $table = 'periksa_lab';


    protected $hidden = [
        'bagian_rs',
        'bhp',
        'biaya',
        'kso',
        'menejemen',
        'tarif_perujuk',
        'tarif_tindakan_dokter',
        'tarif_tindakan_petugas',
    ];




    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function jnsPerawatanLab()
    {
        return $this->belongsTo(JnsPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    public function perujuk()
    {
        return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'kd_dokter');
    }
    function detail(): HasMany
    {
        return $this->hasMany(DetailPemeriksaanLab::class, ['no_rawat', 'tgl_periksa', 'kd_jenis_prw', 'jam'], ['no_rawat', 'tgl_periksa', 'kd_jenis_prw', 'jam'])
            ->select(['no_rawat', 'tgl_periksa', 'kd_jenis_prw', 'jam', 'nilai', 'nilai_rujukan', 'keterangan', 'id_template']);
    }
    function permintaan()
    {
        return $this->belongsTo(PermintaanLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasil']);
    }
}
