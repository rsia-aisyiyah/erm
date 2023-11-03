<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRadiologi extends Model
{
    use HasFactory;
    protected $table = 'hasil_radiologi';
    protected $guarded = [];
    public $timestamps = false;

    function periksaRadiologi()
    {
        return $this->hasMany(PeriksaRadiologi::class, 'no_rawat', 'no_rawat');
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
