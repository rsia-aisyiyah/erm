<?php

namespace App\Models;

use App\Models\ResepObat;
use App\Models\DataBarang;
use App\Models\ResepDokterRacikan;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DataBarangController;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResepDokterRacikanDetail extends Model
{
    use HasFactory, Compoships;
    protected $table = 'resep_dokter_racikan_detail';
    protected $fillable = ['no_resep', 'no_racik', 'kode_brng', 'p1', 'p2', 'kandungan', 'jml'];
    public $timestamps = false;

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'no_resep', 'no_resep');
    }
    public function resepRacikan()
    {
        return $this->belongsTo(ResepDokterRacikan::class, 'no_racik', 'no_racik');
    }
    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
