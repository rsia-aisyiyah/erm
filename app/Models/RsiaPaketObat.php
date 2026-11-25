<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPaketObat extends Model
{
    use HasFactory;

    protected $table = 'rsia_paket_obat';

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(RsiaPaketObatDetail::class, 'paket_id', 'id')->orderBy('urutan', 'asc');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
