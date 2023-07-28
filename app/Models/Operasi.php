<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasi extends Model
{
    use HasFactory;
    protected $table = 'operasi';

    function paketOperasi()
    {
        return $this->belongsTo(PaketOperasi::class, 'kode_paket', 'kode_paket');
    }
}
