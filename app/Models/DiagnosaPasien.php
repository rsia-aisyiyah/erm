<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaPasien extends Model
{
    use HasFactory;
    protected $table = 'diagnosa_pasien';
    protected $fillable = ['no_rawat', 'kd_penyakit', 'status', 'prioritas', 'status_penyakit'];
    public $timestamps = false;
    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'kd_penyakit', 'kd_penyakit');
    }
}
