<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingDokterDpjpVlcaim extends Model
{
    use HasFactory;
    protected $table = 'maping_dokter_dpjpvclaim';

    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
