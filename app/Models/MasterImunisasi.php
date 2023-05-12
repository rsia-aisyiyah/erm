<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterImunisasi extends Model
{
    use HasFactory;
    protected $table = 'master_imunisasi';

    public function riwayatImunisasi()
    {
        return $this->hasMany(RiwayatImunisasi::class, 'kode_imunisasi', 'kode_imunisasi');
    }
}
