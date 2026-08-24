<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaAsesmenGeriatri extends Model
{
    use HasFactory;

    protected $table = 'rsia_asesmen_geriatri';
    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function perawat()
    {
        return $this->belongsTo(Petugas::class, 'nip_perawat', 'nip');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    public function dokterRuangan()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter_ruangan', 'kd_dokter');
    }
}
