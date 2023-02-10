<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanRanap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PemeriksaanRanapController extends Controller
{
    private $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }
    public function ambil(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas']);

        if ($request->tgl_pertama && $request->tgl_kedua) {
            $pemeriksaan->whereBetween('tgl_perawatan', [$request->tgl_pertama, $request->tgl_pertama]);
        } else {
            $pemeriksaan->where('tgl_perawatan', $this->tanggal->now()->toDateString());
        }

        // return response()->json($pemeriksaan->get());

        return DataTables::of($pemeriksaan)->make(true);
    }
}
