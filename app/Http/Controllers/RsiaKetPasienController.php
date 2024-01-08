<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RsiaKetPasien;
use Illuminate\Http\Request;

class RsiaKetPasienController extends Controller
{
    protected $track;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    function get(Request $request)
    {
        $ketPasien = RsiaKetPasien::where('no_rkm_medis', $request->no_rkm_medis)->first();
        return response()->json($ketPasien);
    }
    function create(Request $request)
    {
        $ketPasien = RsiaKetPasien::where('no_rkm_medis', $request->no_rkm_medis)->first();
        if ($ketPasien) {
            $ketPasien = RsiaKetPasien::where('no_rkm_medis', $request->no_rkm_medis)->delete();
            $this->track->deleteSql(new RsiaKetPasien(), ['no_rkm_medis' => $request->no_rkm_medis]);
        }
        $data = [
            'no_rkm_medis' => $request->no_rkm_medis,
            'keterangan' => $request->ket_pasien
        ];
        $keterangan = RsiaKetPasien::create($data);
        if ($keterangan) {
            $this->track->insertSql(new RsiaKetPasien(), $data);
        }
        return response()->json('SUKSES');
    }
}
