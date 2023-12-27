<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanOfCareTim extends Model
{
    use HasFactory;
    protected $table = 'plan_of_care_tim';
    protected $guarded = [];
    public $timestamps = false;

    function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas', 'nip');
    }
}
