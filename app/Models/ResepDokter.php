<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepDokter extends Model
{
    use HasFactory;
    protected $table = "resep_dokter";
    protected $fillable = ['no_resep', 'kode_brng', 'jml', 'aturan_pakai'];
    public $timestamps = false;

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
