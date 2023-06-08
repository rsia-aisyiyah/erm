<?php

namespace App\Models;

use App\Models\DataBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaMappingRacikanDetail extends Model
{
    use HasFactory;
    protected $table = 'rsia_mapping_detail_racikan';
    protected $fillable = ['id_racik', 'kode_brng'];
    public $timestamps = false;

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
