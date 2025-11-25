<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TindakanPerawatRanap extends Model
{
	use HasFactory, Compoships;

	protected $table = 'rawat_inap_pr';
	protected $guarded = [];
	public $timestamps = false;


	function tindakan(): BelongsTo
	{
		return $this->belongsTo(JenisPerawatanInap::class, 'kd_jenis_prw', 'kd_jenis_prw');
	}

	function pasien(): HasOneThrough
	{
		return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}

	function petugas(): BelongsTo
	{
		return $this->belongsTo(Petugas::class, 'nip', 'nip');
	}

	function regPeriksa(): BelongsTo
	{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}

	function kamarInap(): HasMany
	{
		return $this->hasMany(KamarInap::class, 'no_rawat', 'no_rawat');
	}

}
