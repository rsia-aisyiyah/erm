<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TindakanDokterRanap extends Model
{
	use HasFactory, Compoships;

	protected $table = 'rawat_inap_dr';
	protected $guarded = [];
	public $timestamps = false;


	function tindakan():BelongsTo
	{
		return $this->belongsTo(JenisPerawatanInap::class, 'kd_jenis_prw', 'kd_jenis_prw');
	}
	function pasien() : HasOneThrough
	{
		return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}
	function dokter():BelongsTo
	{
		return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
	}
	function kamarInap():HasMany
	{
		return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
	}
	function regPeriksa():BelongsTo
	{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}
}
