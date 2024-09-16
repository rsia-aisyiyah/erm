<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingPoliklinik extends Model
{
    use HasFactory, Compoships;
    protected $table = 'rsia_mapping_poli';
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli', 'kd_poli');
    }

	public function jadwal()
	{
		return $this->hasMany(Jadwal::class, ['kd_poli', 'kd_dokter'], ['kd_poli','kd_dokter']);
	}
}
