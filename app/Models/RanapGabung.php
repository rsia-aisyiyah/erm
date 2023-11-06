<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapGabung extends Model
{
    use HasFactory;
    protected $table = 'ranap_gabung';

    public function kamarInap()
    {
        return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    function kamarIbu()
    {
        return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat2', 'no_rawat');
    }
}
