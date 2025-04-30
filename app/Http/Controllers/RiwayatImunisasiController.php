<?php

namespace App\Http\Controllers;

use App\Models\RiwayatImunisasi;
use Illuminate\Http\Request;

class RiwayatImunisasiController extends Controller
{
    protected $riwayat;
    protected $track;
    public function __construct()
    {
        $this->riwayat = new RiwayatImunisasi();
        $this->track = new TrackerSqlController();
    }
    function get($no_rkm_medis)
    {
        $riwayat = $this->riwayat->where('no_rkm_medis', $no_rkm_medis)->with('masterImunisasi')->get();
        return response()->json($riwayat);
    }
    function insert(Request $request)
    {
        $data = $request->except('_token');
        $riwayat = $this->riwayat->create($data);
        $this->track->insertSql($this->riwayat, $data);
        return response()->json($riwayat);
    }
    function delete(Request $request)
    {
        $clause = [
            'no_rkm_medis' => $request->no_rkm_medis,
            'kode_imunisasi' => $request->kode_imunisasi,
            'no_imunisasi' => $request->no_imunisasi,

        ];

        $riwayat = $this->riwayat->where($clause)->delete();
        $this->track->deleteSql($this->riwayat, $clause);
        return response()->json($riwayat);
    }
}
