<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRencanaKeperawatan extends Model
{
    use HasFactory;
    protected $table = 'master_rencana_keperawatan';
    protected $guarded = [];
    public $timestamps = false;

    function masterMasalah()
    {
        return $this->belongsTo(MasterMasalahKeperawatan::class, 'kode_masalah', 'kode_masalah');
    }
    function askepAnak()
    {
        return $this->hasMany(AsesmenKeperawatanAnak::class, 'no_rawat', 'no_rawat');
    }
}
