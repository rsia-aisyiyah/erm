<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPermintaanDiet extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_permintaan_diet';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
}
