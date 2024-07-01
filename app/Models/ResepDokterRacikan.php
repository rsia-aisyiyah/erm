<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepDokterRacikan extends Model
{
    use Compoships;
    use HasFactory;
    protected $table = 'resep_dokter_racikan';
    protected $fillable = ['no_resep', 'no_racik', 'nama_racik', 'kd_racik', 'jml_dr', 'aturan_pakai', 'keterangan'];
    public $timestamps = false;

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'no_resep', 'no_resep');
    }
    public function metode()
    {
        return $this->hasOne(MetodeRacik::class, 'kd_racik', 'kd_racik');
    }
    public function detailRacikan()
    {
        return $this->hasMany(ResepDokterRacikanDetail::class, 'no_resep', 'no_resep');
    }
    public function detail()
    {
        return $this->hasMany(ResepDokterRacikanDetail::class, ['no_resep', 'no_racik'], ['no_resep', 'no_racik']);
    }
    // public function dataBarang()
    // {
    //     return $this->belongsTo(DataBarang::class, 'kd_barang', 'kd_barang');
    // }
}
