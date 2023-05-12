<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatImunisasi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_imunisasi';

    public function masterImunisasi()
    {
        return $this->belongsTo(MasterImunisasi::class, 'kode_imunisasi', 'kode_imunisasi');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
}
