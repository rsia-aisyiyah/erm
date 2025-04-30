<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterRencanaKeperawatan;
use Yajra\DataTables\DataTables;

class MasterRencanaKeperawatanController extends Controller
{
    //
    protected $rencana;

    public function __construct()
    {
        $this->rencana = new MasterRencanaKeperawatan();
    }

    function getDataTable(Request $request)
    {
        $kode = $request->kode ? $request->kode : ["-"];
        $rencana = $this->rencana->whereIn('kode_masalah', $kode)->get();
        return DataTables::of($rencana)->make(true);
    }
}
