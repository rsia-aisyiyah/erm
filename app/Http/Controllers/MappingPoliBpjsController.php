<?php

namespace App\Http\Controllers;

use App\Models\MappingPoliBpjs;
use Illuminate\Http\Request;

class MappingPoliBpjsController extends Controller
{

    protected $poli;
    public function __construct()
    {
        $this->poli = new  MappingPoliBpjs;
    }
    public function ambil($kdPoli)
    {
        $poli = $this->poli->where('kd_poli_bpjs', $kdPoli)->orWhere('kd_poli_rs', $kdPoli)->where('kd_poli_rs', '!=', 'U0002')->with('poliklinik.mappingPoli.dokter.mappingDokter')->first();
        return response()->json($poli);
    }
}
