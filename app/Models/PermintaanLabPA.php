<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanLabPA extends Model
{
	use HasFactory, Compoships;

	protected $table = 'permintaan_labpa';
	protected $primaryKey = 'noorder';
	protected $keyType = 'string';
	protected $guarded = [];
	public $timestamps = false;


	public function regPeriksa()
	{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}

	public function dokter()
	{
		return $this->belongsTo(Dokter::class, 'dokter_perujuk', 'dokter');
	}

	public function pemeriksaan()
	{
		return $this->hasMany(PermintaanPemeriksaanLabPA::class, 'noorder', 'noorder');
	}

	public function gambar()
	{
		return $this->hasMany(GambarPeriksaLabPA::class, 'no_rawat', 'no_rawat');
	}


}
