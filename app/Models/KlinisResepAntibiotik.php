<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinisResepAntibiotik extends Model
{
    use HasFactory;

    protected $table = 'rsia_klinis_resep_antibiotik';
    protected $primaryKey = ['no_rawat', 'kode_brng', 'no_resep']; // Sebutkan semua kuncinya
    public $incrementing = false; // Karena bukan Auto Increment ID
    protected $keyType = 'string'; // Jika kuncinya berupa string (seperti no_rawat)
    protected $fillable = [
        'no_rawat',
        'kode_brng',
        'no_resep',
        'indikasi_penggunaan',
        'catatan_klinis',
        'tanggal_input',
    ];
    public $timestamps = false;
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->primaryKey as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }
        return $query;
    }

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_brng', 'kode_brng');
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function resep()
    {
        return $this->belongsTo(ResepObat::class, 'no_resep', 'no_resep');
    }

}
