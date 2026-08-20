<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBeriDiet extends Model
{
    use HasFactory, Compoships;

    protected $table = 'detail_beri_diet';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

    public function diet()
    {
        return $this->belongsTo(Diet::class, 'kd_diet', 'kd_diet');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kd_kamar', 'kd_kamar');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
}
