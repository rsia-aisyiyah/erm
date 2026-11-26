<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaOrderSuratKontrolRanap extends Model
{
    use HasFactory;

    protected $table = 'rsia_order_surat_kontrol_ranap';

    protected $guarded = [];

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function sep()
    {
        return $this->belongsTo(BridgingSep::class, 'no_sep', 'no_sep');
    }

    public function resume()
    {
        return $this->belongsTo(ResumePasienRanap::class, 'no_rawat', 'no_rawat');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter_dpjp', 'kd_dokter');
    }

    public function suratKontrol()
    {
        return $this->belongsTo(RencanaKontrol::class, 'no_surat_kontrol', 'no_surat');
    }
}
