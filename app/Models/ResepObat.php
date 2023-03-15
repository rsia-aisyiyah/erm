<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\RegPeriksa;
use App\Models\ResepDokter;
use App\Models\ResepDokterRacikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResepObat extends Model
{
    use HasFactory;
    protected $table = "resep_obat";
    public $timestamps = false;
    protected $fillable = ['no_resep', 'tgl_perawatan', 'jam', 'no_rawat', 'kd_dokter', 'tgl_peresepan', 'jam_peresepan', 'status', 'tgl_penyerahan', 'jam_penyerahan'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
    public function resepDokter()
    {
        return $this->hasMany(ResepDokter::class, 'no_resep', 'no_resep');
    }
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function resepRacikan()
    {
        return $this->hasMany(ResepDokterRacikan::class, 'no_resep', 'no_resep');
    }
    public function detailRacikan()
    {
        return $this->hasMany(ResepDokterRacikanDetail::class, 'no_resep', 'no_resep');
    }
}
