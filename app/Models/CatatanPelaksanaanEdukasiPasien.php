<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class CatatanPelaksanaanEdukasiPasien extends Model
{
    use HasFactory, Compoships;

	protected $table = 'rsia_catatan_pelaksanaan_edukasi_pasien';
	protected $guarded = [];
	public $timestamps = false;

	public function pasien(): HasOneThrough{
		return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}
	public function regPeriksa(): BelongsTo{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}
	public function dokter() : HasOneThrough
	{
		return $this->hasOneThrough(Dokter::class, RegPeriksa::class, 'no_rawat', 'kd_dokter',  'no_rawat', 'kd_dokter');
	}
	public  function petugas() : BelongsTo
	{
		return $this->belongsTo(Petugas::class, 'nip', 'nip');
	}
}
