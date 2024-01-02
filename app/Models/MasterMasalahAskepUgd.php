<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMasalahAskepUgd extends Model
{
    use HasFactory;
    protected $table = 'master_masalah_keperawatan_igd';

    function masterRencana()
    {
        return  $this->hasMany(MasterRencanaAskepUgd::class, 'kode_masalah', 'kode_masalah');
    }
}
