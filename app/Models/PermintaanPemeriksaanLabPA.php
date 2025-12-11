<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPemeriksaanLabPA extends Model
{
	use HasFactory, Compoships;

	protected $table = 'permintaan_pemeriksaan_labpa';
	protected $primaryKey = 'noorder';
	protected $keyType = 'string';
	protected $guarded = [];
	public $timestamps = false;

	public function permintaan()
	{
		return $this->belongsTo(PermintaanLabPA::class, 'noorder', 'noorder');
	}

	public function jenis()
	{
		return $this->belongsTo(JnsPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
	}
	public function detail()
	{
		return $this->hasManyThrough(DetailPeriksaLabPA::class,  ['no_rawat', 'tgl_periksa', 'jam'], ['no_rawat', 'tgl_hasil', 'jam_hasil']);
	}
}
