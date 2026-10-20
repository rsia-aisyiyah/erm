<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelaahFarmasi extends Model
{
    use HasFactory;

    protected $table = 'telaah_farmasi';
    protected $primaryKey = 'no_resep';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'no_resep', 'no_resep');
    }

    public function permintaanStok()
    {
        return $this->belongsTo(PermintaanStokObatPasien::class, 'no_resep', 'no_permintaan');
    }
}
