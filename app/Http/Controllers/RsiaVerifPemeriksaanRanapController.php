<?php

namespace App\Http\Controllers;

use App\Models\RsiaVerifPemeriksaanRanap;
use Illuminate\Http\Request;

class RsiaVerifPemeriksaanRanapController extends Controller
{
    protected $verif;
    protected $track;

    public function __construct()
    {
        $this->verif = new RsiaVerifPemeriksaanRanap();
        $this->track = new TrackerSqlController();
    }

    function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
            'tgl_verif' => date('Y-m-d'),
            'jam_verif' => date('H:i:s'),
            'verifikator' => session()->get('pegawai')->nik,
        ];

        $verif = $this->verif->create($data);
        $this->track->insertSql($this->verif, $data);

        return response()->json($verif);
    }
}
