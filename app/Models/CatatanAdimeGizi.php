<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanAdimeGizi extends Model
{
    use HasFactory;
    protected $table = 'catatan_adime_gizi';
    protected $primaryKey = ['no_rawat', 'tanggal'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'no_rawat',
        'tanggal',
        'asesmen',
        'diagnosis',
        'intervensi',
        'monitoring',
        'evaluasi',
        'instruksi',
        'nip'
    ];


    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->primaryKey as $key) {

            $query->where(
                $key,
                '=',
                $this->getOriginal($key) ?? $this->getAttribute($key)
            );
        }

        return $query;
    }

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip')->select('nip', 'nama');
    }
    public function pasien()
    {
        return $this->hasOneThrough(
            Pasien::class,
            RegPeriksa::class,
            'no_rawat', // Foreign key on RawatInap table...
            'no_rkm_medis', // Foreign key on Pasien table...
            'no_rawat', // Local key on CatatanAdimeGizi table...
            'no_rkm_medis' // Local key on RawatInap table...
        )->select('pasien.no_rkm_medis', 'nm_pasien', 'jk', 'tgl_lahir');
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat')
            ->select('no_rawat', 'no_rkm_medis', 'kd_poli', 'kd_dokter', 'tgl_registrasi', 'jam_reg');
    }
    public function kamarInap()
    {
        return $this->belongsTo(
            KamarInap::class,
            'no_rawat',
            'no_rawat'
        )->select('no_rawat', 'kd_kamar', 'tgl_masuk', 'tgl_keluar', 'kd_kamar');
    }
}
