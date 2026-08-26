<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaTriasePreRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'rsia_triase_pre_registrasi';
    protected $primaryKey = 'id_triase';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_triase',
        'tgl_triase',
        'nama_pasien_temp',
        'jk',
        'umur_temp',
        'cara_masuk',
        'alat_transportasi',
        'alasan_kedatangan',
        'keterangan_kedatangan',
        'kode_kasus',
        'tekanan_darah',
        'nadi',
        'pernapasan',
        'suhu',
        'saturasi_o2',
        'gcs',
        'nyeri',
        'skala_triase',
        'kategori_triase',
        'detail_skala_json',
        'nip_petugas',
        'status_link',
        'no_rawat',
        'no_rkm_medis',
        'tgl_linked',
        'nip_linker',
    ];

    protected $casts = [
        'detail_skala_json' => 'array',
    ];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip_petugas', 'nip');
    }

    public function linker()
    {
        return $this->belongsTo(Petugas::class, 'nip_linker', 'nip');
    }
}
