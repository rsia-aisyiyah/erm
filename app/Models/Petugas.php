<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';

    protected $hidden = [
        'agama',
        'alamat',
        'jk',
        'gol_darah',
        'tmp_lahir',
        'tgl_lahir',
        'stts_nikah',
        'no_telp',
    ];

    public function periksaLab()
    {
        return $this->hasMany(PeriksaLab::class, 'nip', 'nip');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'nip', 'kd_dokter');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik')
            ->select('nik', 'nama', 'departemen');
    }
}
