<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranKesanLab extends Model
{
    use HasFactory, Compoships;

    protected $table = 'saran_kesan_lab';
    protected $guarded = [];
    // protected $primaryKey = ['no_rawat', 'tgl_periksa', 'jam'];

    public $timestamps = false;

    public function periksaLab()
    {
        return $this->belongsTo(PeriksaLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_periksa', 'jam']);
    }
    public function permintaan()
    {
        return $this->belongsTo(PermintaanLab::class, ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasil']);
    }
}
