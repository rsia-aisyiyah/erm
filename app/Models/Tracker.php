<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory, Compoships;

    protected $table = 'tracker';
    public $timestamps = false;
    protected $guarded = [];


    public function petugas()
    {
        return $this->belongsTo(Pegawai::class, 'nik', 'nik');
    }


}
