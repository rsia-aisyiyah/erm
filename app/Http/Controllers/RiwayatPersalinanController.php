<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPersalinan;
use Illuminate\Http\Request;

class RiwayatPersalinanController extends Controller
{
    protected $persalinan;
    protected $track;
    public function __construct()
    {
        $this->persalinan = new RiwayatPersalinan();
        $this->track = new TrackerSqlController();
    }
    function get($no_rkm_medis)
    {
        $persalinan = $this->persalinan->where('no_rkm_medis', $no_rkm_medis)->get();
        return response()->json($persalinan);
    }
    function insert(Request $request)
    {
        $data = $request->except('_token');
        $persalinan = $this->persalinan->create();
        $this->track->insertSql($this->persalinan, $data);
        return response()->json($persalinan);
    }
    function delete(Request $request)
    {
        $clause = [
            'no_rkm_medis' => $request->no_rkm_medis,
            'tgl_thn' => $request->tgl_thn,
        ];
        $persalinan = $this->persalinan->where($clause)->delete();
        $this->track->deleteSql($this->persalinan, $clause);
        return response()->json($persalinan);
    }
}
