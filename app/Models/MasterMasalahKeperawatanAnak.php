<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterMasalahKeperawatanAnak extends Model
{
    use HasFactory;
    protected $table = 'master_masalah_keperawatan_anak';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'kode_masalah';
    public $incrementing = false;
    protected $keyType = 'string';

    function masterRencana()
    {
        return $this->hasMany(MasterRencanaKeperawatanAnak::class, 'kode_masalah', 'kode_masalah');
    }
}
