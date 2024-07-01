<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RsiaMappingRacikanDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaMappingRacikan extends Model
{
    use HasFactory;
    protected $table = 'rsia_mapping_racik';
    protected $fillable = ['kd_dokter', 'nm_racik'];
    public $timestamps = false;

    public function databarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function detail()
    {
        return $this->hasMany(RsiaMappingRacikanDetail::class, 'id_racik', 'id');
    }
}
