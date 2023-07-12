<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BridgingRujukanBpjs extends Model
{
    use HasFactory;
    protected $table = 'bridging_rujukan_bpjs';
    protected $fillable = ['no_sep', 'tglRujukan', 'tglRencanaKontrol', 'ppkDirujuk', 'nm_ppkDirujuk', 'jnsPelayanan', 'catatan', 'diagRujukan', 'poliRujukan', 'nama_poliRujukan', 'no_rujukan', 'user'];
    public $timestamps = false;
}
