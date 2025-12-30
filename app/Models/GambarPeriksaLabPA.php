<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarPeriksaLabPA extends Model
{
    use HasFactory, Compoships;

	protected $table = 'detail_periksa_labpa_gambar';
	protected $primaryKey = 'no_rawat';
	protected $keyType = 'string';
	protected $guarded = [];
	public $timestamps = false;
}
