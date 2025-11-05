<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisPerawatanInap extends Model
{
	use HasFactory, Compoships;

	protected $table = 'jns_perawatan_inap';
	protected $primaryKey = 'kd_jenis_prw';
	protected $keyType = 'string';
	public $timestamps = false;
	protected $guarded = [];

	public function kategori():BelongsTo
	{
		return $this->belongsTo(KategoriPerawatan::class, 'kd_kategori', 'kd_kategori');
	}
	public function penjab():BelongsTo
	{
		return $this->belongsTo(Penjab::class, 'kd_pj', 'kd_pj');
	}
	public function bangsal() : BelongsTo
	{
		return $this->belongsTo(Bangsal::class, 'kd_bangsal', 'kd_bangsal');
	}

}
