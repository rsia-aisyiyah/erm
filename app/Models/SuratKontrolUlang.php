<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKontrolUlang extends Model
{
    use HasFactory;
    protected $table = 'surat_kontrol_ulang';
    protected $fillable = ['no_surat', 'no_rkm_medis', 'no_rawat', 'jenis', 'tanggal', 'dokter'];
    public $timestamps = false;
}
