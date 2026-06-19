<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRencanaKeperawatanAnak extends Model
{
    use HasFactory;
    protected $table = 'master_rencana_keperawatan_anak';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'kode_rencana';
    public $incrementing = false;
    protected $keyType = 'string';
}
