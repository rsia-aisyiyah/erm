<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksaLabPA extends Model
{
	use HasFactory, Compoships;


	protected $table = 'detail_periksa_labpa';
	protected $primaryKey = 'no_rawat';
	protected $keyType = 'string';
	protected $guarded = [];
	public $timestamps = false;

	public function regPeriksa()
	{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}

	public function jenis()
	{
		return $this->belongsTo(JnsPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
	}


}
