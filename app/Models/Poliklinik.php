<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory, Compoships;
    protected $table = 'poliklinik';

    public function poliBpjs()
    {
        return $this->hasMany(MappingPoliBpjs::class, 'kd_poli', 'kd_poli_rs');
    }
    public function mappingPoli()
    {
        return $this->hasMany(MappingPoliklinik::class, 'kd_poli', 'kd_poli');
    }
    public function regPeriksa()
    {
        return $this->hasMany(RegPeriksa::class, 'kd_poli', 'kd_poli');
    }
}
