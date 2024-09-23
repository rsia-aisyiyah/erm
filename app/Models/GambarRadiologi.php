<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarRadiologi extends Model
{
    use HasFactory, Compoships;
    protected $table = 'gambar_radiologi';
    protected $guarded = [];
    public $timestamps = false;
}
