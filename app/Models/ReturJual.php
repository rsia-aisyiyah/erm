<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturJual extends Model
{
    use HasFactory;

    protected $table = 'returjual';
    protected $primaryKey = 'no_retur_jual';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(DetailReturJual::class, 'no_retur_jual', 'no_retur_jual');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

    public function bangsal()
    {
        return $this->belongsTo(Bangsal::class, 'kd_bangsal', 'kd_bangsal');
    }
}
