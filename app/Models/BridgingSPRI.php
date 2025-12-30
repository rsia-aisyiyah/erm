<?php

namespace App\Models;

use App\Models\Pasien;
use App\Models\RegPeriksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BridgingSPRI extends Model
{
	use HasFactory;

	protected $table = 'bridging_surat_pri_bpjs';
	protected $fillable = ['no_rawat', 'no_kartu', 'tgl_surat', 'no_surat', 'tgl_rencana', 'kd_dokter_bpjs', 'nm_dokter_bpjs', 'kd_poli_bpjs', 'nm_poli_bpjs', 'diagnosa', 'sep'];
	public $timestamps = false;

	function regPeriksa()
	{
		return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
	}

	function pasien()
	{
		return $this->belongsTo(Pasien::class, 'no_kartu', 'no_peserta');
	}

	function mappingPoli()
	{
		return $this->belongsTo(MappingPoliBpjs::class, 'kd_poli_bpjs', 'kd_poli_bpjs');
	}

	public function poliklinik()
	{
		return $this->hasManyThrough(
			Poliklinik::class,        // final model
			MappingPoliBpjs::class,   // intermediate model
			'kd_poli_bpjs',           // FK di mapping_poli_bpjs
			'kd_poli',                // PK di poliklinik
			'kd_poli_bpjs',           // FK di bridging_surat_pri_bpjs
			'kd_poli_rs'              // FK di mapping_poli_bpjs ke poliklinik
		)->select(['kd_poli', 'nm_poli']);
	}
}
