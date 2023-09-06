<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaLogSoap extends Model
{
    use HasFactory;
    protected $table = 'rsia_log_soap';
    protected $guarded = [];
    public $timestamps = false;

    function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }
}
