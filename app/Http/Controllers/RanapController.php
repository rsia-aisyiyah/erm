<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KamarInap;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RanapController extends Controller
{
    public $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }
    public function index()
    {
        return view('content.ranap.ranap');
    }
    public function ranap(Request $request)
    {

        $ranap = KamarInap::with(['regPeriksa', 'regPeriksa.pasien', 'regPeriksa.dokter', 'regPeriksa.dokter.spesialis', 'kamar', 'ranapGabung', 'ranapGabung.regPeriksa', 'kamar.bangsal']);

        if ($request->stts_pulang == '-') {
            $ranap->where('stts_pulang', $request->stts_pulang);
        } else if ($request->stts_pulang == 'Masuk') {
            $ranap->whereBetween('tgl_masuk', [$request->tgl_pertama, $request->tgl_kedua]);
            // $ranap->where('stts_pulang', '-');
        } else if ($request->stts_pulang == 'Pulang') {
            $ranap->whereBetween('tgl_keluar', [$request->tgl_pertama, $request->tgl_kedua]);
        }

        return DataTables::of($ranap)->make(true);
    }
}
