<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BridgingRujukanBpjs extends Model
{
    use HasFactory;
    protected $table = 'bridging_rujukan_bpjs';
    protected $fillable = ['no_sep', 'tglRujukan', 'tglRencanaKunjungan', 'ppkDirujuk', 'nm_ppkDirujuk', 'jnsPelayanan', 'nama_diagRujukan', 'catatan', 'diagRujukan', 'poliRujukan', 'tipeRujukan', 'nama_poliRujukan', 'no_rujukan', 'user'];
    public $timestamps = false;
}
