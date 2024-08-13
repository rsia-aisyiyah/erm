<?php

namespace App\Models;

use App\Models\DetailPermintaanLab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PermintaanLab extends Model
{
    use HasFactory;
    protected $table = 'permintaan_lab';
    protected $guarded = [];
    public $timestamps = false;

    function pemeriksaan(): HasMany
    {
        return $this->hasMany(PermintaanPemeriksaanLab::class, 'noorder', 'noorder');
    }
    function detail(): HasMany
    {
        return $this->hasMany(DetailPermintaanLab::class, 'noorder', 'noorder');
    }
}
