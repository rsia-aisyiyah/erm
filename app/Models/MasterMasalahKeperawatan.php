<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterRencanaKeperawatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterMasalahKeperawatan extends Model
{
    use HasFactory;
    protected $table = 'master_masalah_keperawatan';
    protected $guarded = [];
    public $timestamps = false;

    function masterRencana()
    {
        return $this->hasMany(MasterRencanaKeperawatan::class, 'kode_masalah', 'kode_masalah');
    }
}
