<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaAsoPemeriksaanRanap extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_aso_pemeriksaan_ranap';
    protected $fillable = [
        'no_rawat',
        'tgl_perawatan',
        'jam_rawat',
        'tgl_aso',
        'nip_apoteker',
        'status_aso',
        'catatan_aso',
    ];
    public $timestamps = false;
    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function pemeriksaanRanap()
    {
        return $this->belongsTo(PemeriksaanRanap::class, ['no_rawat', 'tgl_perawatan', 'jam_rawat'], ['no_rawat', 'tgl_perawatan', 'jam_rawat']);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip_apoteker', 'nip');
    }
}
