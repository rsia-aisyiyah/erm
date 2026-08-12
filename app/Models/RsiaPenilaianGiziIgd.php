<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaPenilaianGiziIgd extends Model
{
    use HasFactory;

    protected $table = 'rsia_penilaian_gizi_igd';
    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    public function regPeriksa()
    {
        return $this->belongsTo(RegPeriksa::class, 'no_rawat', 'no_rawat');
    }

    public function askepUgd()
    {
        return $this->belongsTo(AskepUgd::class, 'no_rawat', 'no_rawat');
    }
}
