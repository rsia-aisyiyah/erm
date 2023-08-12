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

        $ranap = KamarInap::with(['regPeriksa.pasien', 'regPeriksa.dokter', 'regPeriksa.dokter.spesialis', 'kamar', 'ranapGabung', 'ranapGabung.regPeriksa', 'kamar.bangsal', 'regPeriksa.penjab']);

        if ($request->stts_pulang == '-') {
            $ranap->where('stts_pulang', $request->stts_pulang);
        } else if ($request->stts_pulang == 'Masuk') {
            $ranap->whereBetween('tgl_masuk', [$request->tgl_pertama, $request->tgl_kedua]);
        } else if ($request->stts_pulang == 'Pulang') {
            $ranap->whereBetween('tgl_keluar', [$request->tgl_pertama, $request->tgl_kedua]);
        }

        if ($request->kd_dokter) {
            $ranap->whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('kd_dokter', $request->kd_dokter);
            });
        }

        if ($request->kamar) {
            $ranap->whereHas('kamar.bangsal', function ($q) use ($request) {
                $q->where('nm_bangsal', 'like', '%' . $request->kamar . '%');
            });
        }

        return DataTables::of($ranap)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('regPeriksa.pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })->make(true);
    }
}
