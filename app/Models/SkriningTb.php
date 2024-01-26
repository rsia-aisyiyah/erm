<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningTb extends Model
{
    use HasFactory;
    protected $table = 'rsia_skrining_tb';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat'); //
    }
    function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
