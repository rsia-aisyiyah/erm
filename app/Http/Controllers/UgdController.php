<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UgdController extends Controller
{
    protected $regPeriksa;
    protected $carbon;
    public function __construct()
    {
        $this->regPeriksa = new RegPeriksa();
        $this->carbon = new Carbon();
    }
    function index()
    {
        return view('content.ugd.index');
    }

    function getTable(Request $request)
    {
        $regPeriksa = $this->regPeriksa->with(['pasien', 'dokter', 'kamarInap', 'penjab'])->where('kd_poli', 'IGDK');

        if ($request->tgl_awal || $request->tgl_akhir) {
            $regPeriksa->whereBetween('tgl_registrasi', [$request->tgl_awal, $request->tgl_akhir])->get();
        } else {
            $regPeriksa->where('tgl_registrasi', date('Y-m-d'))->get();
        }

        if ($request->nm_pasien) {
            $regPeriksa->whereHas('pasien', function ($q) use ($request) {
                return $q->where('nm_pasien', $request->nm_pasien);
            })->get();
        }

        return DataTables::of($regPeriksa)->make(true);
    }
}
