<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
}
