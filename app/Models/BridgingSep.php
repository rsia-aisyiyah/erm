<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BridgingSep extends Model
{
    use HasFactory;
    protected $table = 'bridging_sep';

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function suratKontrol()
    {
        return $this->hasOne(RencanaKontrol::class, 'no_sep', 'no_sep');
    }
}
