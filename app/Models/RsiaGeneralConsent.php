<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaGeneralConsent extends Model
{
    use HasFactory;
    protected $table = 'rsia_general_consent';
    protected $fillable = ['id', 'no_rawat', 'ttd', 'tgl_persetujuan', 'jam_persetujuan', 'nik', 'status', 'loket'];
    public $timestamps = false;

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class . 'no_rawat', 'no_rawat');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nik', 'nik');
    }
}
