<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JnsPerawatanLab extends Model
{
    use HasFactory;
    protected $table = 'jns_perawatan_lab';
    public function detailPemeriksaanLab()
    {
        return $this->hasMany(DetailPemeriksaanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
}
