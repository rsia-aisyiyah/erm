<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingDokterBpjs extends Model
{
	use HasFactory;

	protected $table = 'maping_dokter_dpjpvclaim';

	public function dokter()
	{
		return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
	}
}
