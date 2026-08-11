<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TransferPasienAntarRuang extends Model
{
    use HasFactory, Compoships;

    protected $table = 'transfer_pasien_antar_ruang';
    protected $primaryKey = ['no_rawat', 'tanggal_masuk'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    public function regPeriksa(): BelongsTo
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function pasien(): HasOneThrough
    {
        return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
    }

    public function kamarInap(): BelongsTo
    {
        return $this->belongsTo(KamarInap::class, 'no_rawat', 'no_rawat');
    }

    public function petugasMenyerahkan(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'nip_menyerahkan', 'nip');
    }

    public function pegawaiMenyerahkan(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'nip_menyerahkan', 'nik');
    }

    public function petugasMenerima(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'nip_menerima', 'nip');
    }

    public function pegawaiMenerima(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'nip_menerima', 'nik');
    }

    public function bukti(): HasOne
    {
        return $this->hasOne(BuktiPersetujuanTransferPasienAntarRuang::class, ['no_rawat', 'tanggal_masuk'], ['no_rawat', 'tanggal_masuk']);
    }
}
