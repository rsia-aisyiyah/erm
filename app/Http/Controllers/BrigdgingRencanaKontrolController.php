<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RencanaKontrol;
use Illuminate\Routing\Controller;
use Illuminate\Database\QueryException;
use App\Http\Controllers\TrackerSqlController;

class BrigdgingRencanaKontrolController extends Controller
{
    protected $rencanaKontrol;
    protected $track;

    public function __construct()
    {
        $this->rencanaKontrol = new RencanaKontrol();
        $this->track = new TrackerSqlController();
    }

    public function create(Request $request)
    {
        $data = [
            'no_sep' => $request->no_sep,
            'tgl_surat' => $request->tgl_surat,
            'no_surat' => $request->no_surat,
            'tgl_rencana' => $request->tgl_rencana,
            'kd_dokter_bpjs' => $request->kd_dokter_bpjs,
            'nm_dokter_bpjs' => $request->nm_dokter_bpjs,
            'kd_poli_bpjs' => $request->kd_poli_bpjs,
            'nm_poli_bpjs' => ucfirst(strtolower($request->nm_poli_bpjs)),
        ];

        try {
            $rencanaKontrol = $this->rencanaKontrol->create($data);
            $track = $this->track->create($this->rencanaKontrol, $data, session()->get('pegawai')->nik);
            return response()->json($rencanaKontrol);
        } catch (QueryException $e) {
            return response()->json(['metaData' => ['Status' => 'FAILED', 'Code' => 400], 'response' => $e->errorInfo]);
        }
    }
}
