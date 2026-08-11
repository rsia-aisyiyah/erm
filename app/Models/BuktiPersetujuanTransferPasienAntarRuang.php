<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPersetujuanTransferPasienAntarRuang extends Model
{
    use HasFactory, Compoships;

    protected $table = 'bukti_persetujuan_transfer_pasien_antar_ruang';
    protected $primaryKey = ['no_rawat', 'tanggal_masuk'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
}
