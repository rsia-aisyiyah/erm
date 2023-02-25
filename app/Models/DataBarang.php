<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'databarang';

    public function detailPemberianObat()
    {
        return $this->belongsTo(DetailPemberianObat::class, 'kode_brng', 'kode_brng');
    }
    public function kodeSatuan()
    {
        return $this->belongsTo(KodeSatuan::class, 'kode_sat', 'kode_sat');
    }
    public function kodeSatuanBesar()
    {
        return $this->belongsTo(KodeSatuan::class, 'kode_satbesar', 'kode_sat');
    }
    public function industriFarmasi()
    {
        return $this->belongsTo(IndustriFarmasi::class, 'kode_industri', 'kode_industri');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kode_kategori', 'kode');
    }
    public function golongan()
    {
        return $this->belongsTo(GolonganBarang::class, 'kode_golongan', 'kode');
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'kdjns', 'kdjns');
    }
    public function semua()
    {
        return $this->with(['jenis', 'kodeSatuan', 'kodeSatuanBesar', 'industriFarmasi', 'kategori', 'golongan']);
    }
}
