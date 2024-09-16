<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class RsiaAsuhanGiziAnak extends Model
{
    use HasFactory;
	protected $table = 'rsia_asuhan_gizi_anak';
	protected $guarded = [];
	public $timestamps = false;

	public function pasien(): HasManyThrough{
		return $this->hasManyThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}
}
