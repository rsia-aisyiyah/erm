<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPerawatan extends Model
{
    use HasFactory;
    protected $table = 'catatan_perawatan';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'jam', 'no_rawat', 'kd_dokter', 'catatan'];
}
