<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaKontrol extends Model
{
    use HasFactory;
    protected $table = 'bridging_surat_kontrol_bpjs';
    protected $fillable = ['no_sep', 'tgl_surat', 'no_surat', 'tgl_rencana', 'kd_dokter_bpjs', 'nm_dokter_bpjs', 'kd_poli_bpjs', 'nm_poli_bpjs'];
    public $timestamps = false;

    function sep()
    {
        return $this->belongsTo(BridgingSep::class, 'no_sep', 'no_sep');
    }
    function mappingDokter()
    {
        return $this->belongsTo(MappingDokterDpjpVlcaim::class, 'kd_dokter_bpjs', 'kd_dokter_bpjs');
    }
}
