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
		return $this->hasOneThrough(Pasien::class, RegPeriksa::class, 'no_rawat', 'no_rkm_medis', 'no_rawat', 'no_rkm_medis');
	}
	 function regPeriksa(){
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    function pegawai(){
        return $this->belongsTo(Pegawai::class, 'nip', 'nik');
    }

    function kamarInap(){
        return $this->belongsTo(KamarInap::class, 'no_rawat', 'no_rawat');
    }

}
