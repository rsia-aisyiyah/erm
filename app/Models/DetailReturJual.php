<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturJual extends Model
{
    use HasFactory;

    protected $table = 'detreturjual';
    public $timestamps = false;
    public $incrementing = false;

    protected $guarded = [];

    public function returJual()
    {
        return $this->belongsTo(ReturJual::class, 'no_retur_jual', 'no_retur_jual');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'kode_brng', 'kode_brng');
    }
}
