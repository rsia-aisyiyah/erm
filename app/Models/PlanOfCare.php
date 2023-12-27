<?php

namespace App\Models;

use App\Models\Petugas;
use App\Models\RegPeriksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanOfCare extends Model
{
    use HasFactory;
    protected $table = 'plan_of_care';
    protected $guarded = [];
    public $timestamps = false;

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    function tim()
    {
        return $this->hasMany(PlanOfCareTim::class, 'no_rawat', 'no_rawat');
    }
    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas', 'nip');
    }
}
