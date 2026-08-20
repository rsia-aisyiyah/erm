<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningGizi extends Model
{
    use HasFactory, Compoships;

    protected $table = 'skrining_gizi';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];
}
