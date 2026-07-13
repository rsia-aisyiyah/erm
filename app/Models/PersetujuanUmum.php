<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanUmum extends Model
{
    use HasFactory;

    protected $table = 'persetujuan_umum';
    protected $fillable = ['no_rawat', 'tgl_persetujuan', 'file'];
    public $timestamps = false;
}
