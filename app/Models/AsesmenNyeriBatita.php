<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenNyeriBatita extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_asesmen_nyeri_anak_1bl3th';

    protected $guarded = [];

    public $timestamps = false;

    function petugas(){
        return $this->belongsTo(Petugas::class, 'nip', 'nip');  
    }

}
