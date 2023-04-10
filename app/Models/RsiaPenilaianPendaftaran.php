<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPenilaianPendaftaran extends Model
{
    use HasFactory;
    protected $table = 'rsia_penilaian_pendaftaran';
    protected $fillable = ['nik', 'id', 'nilai'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nik', 'nik');
    }
}
