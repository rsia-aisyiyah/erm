<?php

namespace App\Models;

use App\Models\RegPeriksa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KamarInap extends Model
{
    use HasFactory;
    protected $table = 'kamar_inap';
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function ranapGabung()
    {
        return $this->belongsTo(RanapGabung::class, 'no_rawat', 'no_rawat');
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kd_kamar', 'kd_kamar');
    }
    public function resume()
    {
        return $this->hasOne(ResumePasienRanap::class, 'no_rawat', 'no_rawat');
    }
    public function asmedKandungan()
    {
        return $this->hasOne(AsesmenMedisRanapKandungan::class, 'no_rawat', 'no_rawat');
    }
    public function asmedAnak()
    {
        return $this->hasOne(AsesmenMedisAnak::class, 'no_rawat', 'no_rawat');
    }
    public function askepAnak()
    {
        return $this->hasOne(AskepRanapAnak::class, 'no_rawat', 'no_rawat');
    }
    public function askepNeonatus()
    {
        return $this->hasOne(AskepRanapNeonatus::class, 'no_rawat', 'no_rawat');
    }
    public function skoringTb(): BelongsTo
    {
        return $this->belongsTo(SkoringTb::class, 'no_rawat', 'no_rawat');
    }
    public function skriningTb(): BelongsTo
    {
        return $this->belongsTo(SkriningTb::class, 'no_rawat', 'no_rawat');
    }
    public function edukasiObatPulang(): BelongsTo
    {
        return $this->belongsTo(KomunikasiEdukasiObatPulang::class, 'no_rawat', 'no_rawat');
    }

    function dischargePlanning(){
        return $this->hasOne(DischargePlanning::class, 'no_rawat', 'no_rawat');
    }
}
