<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JnsPerawatanLab extends Model
{
    use HasFactory;
    protected $table = 'jns_perawatan_lab';
    public function detailPemeriksaanLab(): HasMany
    {
        return $this->hasMany(DetailPemeriksaanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    function template(): HasMany
    {
        return $this->hasMany(TemplateLaboratorium::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
}
