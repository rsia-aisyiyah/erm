<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaMasterTriasePemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'rsia_master_triase_pemeriksaan';




    function skala1() {
        return $this->hasMany(RsiaMasterTriaseSkala1::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }

    function skala2() {
        return $this->hasMany(RsiaMasterTriaseSkala2::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }

    function skala3() {
        return $this->hasMany(RsiaMasterTriaseSkala3::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }

    function skala4() {
        return $this->hasMany(RsiaMasterTriaseSkala4::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }

    function skala5() {
        return $this->hasMany(RsiaMasterTriaseSkala5::class, 'kode_pemeriksaan', 'kode_pemeriksaan');
    }
}
