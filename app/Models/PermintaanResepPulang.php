<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanResepPulang extends Model
{
    use HasFactory;

    protected $table = 'permintaan_resep_pulang';
    protected $primaryKey = 'no_permintaan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany(DetailPermintaanResepPulang::class, 'no_permintaan', 'no_permintaan');
    }

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
