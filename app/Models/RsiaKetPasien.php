<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaKetPasien extends Model
{
    use HasFactory;
    protected $table = 'rsia_ket_pasien';
    protected $guarded = [];
    public $timestamps = false;
}
