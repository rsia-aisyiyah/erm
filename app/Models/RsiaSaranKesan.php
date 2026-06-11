<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaSaranKesan extends Model
{
    use HasFactory, Compoships;

    protected $table = 'rsia_saran_kesan';
    protected $fillable = ['noorder', 'kd_dokter', 'saran', 'kesan'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');

    }
    public function permintaanLab()
    {
        return $this->belongsTo(PermintaanLab::class, 'noorder', 'noorder');
    }
}
