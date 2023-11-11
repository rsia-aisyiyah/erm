<?php

namespace App\Models;

use App\Models\MasterRencanaAskepUgd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RencanaAskepUgd extends Model
{
    use HasFactory;
    protected $table = 'penilaian_awal_keperawatan_ralan_rencana_igd';

    function masterRencana()
    {
        return $this->belongsTo(MasterRencanaAskepUgd::class, 'kode_rencana', 'kode_rencana');
    }
}
