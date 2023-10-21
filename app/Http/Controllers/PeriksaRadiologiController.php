<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriksaRadiologi;
use Yajra\DataTables\DataTables;

class PeriksaRadiologiController extends Controller
{
    protected $track;
    protected $pemeriksaan;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->pemeriksaan = new PeriksaRadiologi();
    }

    function view()
    {
        return view('content.radiologi.radiologi');
    }

    function getByNoRawat(Request $request)
    {
        $periksa = $this->pemeriksaan->with(['gambarRadiologi', 'petugas', 'hasilRadiologi', 'jnsPerawatan', 'regPeriksa.pasien', 'regPeriksa.penjab', 'permintaanRadiologi', 'regPeriksa.poliklinik']);
        if ($request->tgl_periksa) {
            return $periksa->where([
                'no_rawat' => $request->no_rawat,
                'tgl_periksa' => $request->tgl_periksa,
                'jam' => $request->jam,
            ])->first();
        } else {
            return $periksa->where('no_rawat', $request->no_rawat)->get();
        }
    }
    function index()
    {
        $pemeriksaan = $this->pemeriksaan->where([
            'tgl_periksa' => date('Y-m-d'),
        ])->with(['regPeriksa.pasien', 'dokterRujuk', 'jnsPerawatan', 'hasilRadiologi', 'permintaanRadiologi'])->get();

        return $pemeriksaan;
    }

    function update(Request $request)
    {
        $data = [
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];

        return $data;
        // return $this->pemeriksaan->where([
        //     'no_rawat' => $request->no_rawat,
        //     'tgl_periksa' => $request->tgl_periksa,
        //     'jam' => $request->jam,
        // ])->update($request->all())
    }
    function getParameter(Request $request)
    {
        $pemeriksaan = $this->pemeriksaan;
        if ($request->tgl_awal) {
            $pemeriksaan = $pemeriksaan->whereBetween('tgl_periksa', [$request->tgl_awal, $request->tgl_akhir]);
        }
        if ($request->spesialis) {
            $pemeriksaan = $pemeriksaan->whereHas('dokterRujuk.spesialis', function ($query) use ($request) {
                $query->where('kd_sps', $request->spesialis);
            });
        }
        if ($request->status) {
            $pemeriksaan = $pemeriksaan->where('status', $request->status);
        }
        return $pemeriksaan->with(['regPeriksa.pasien', 'dokterRujuk', 'jnsPerawatan', 'hasilRadiologi', 'permintaanRadiologi'])->get();
    }
    function getTableIndex(Request $request)
    {
        // return;
        if ($request->tgl_awal || $request->spesialis || $request->status) {
            $pemeriksaan = $this->getParameter($request);
        } else {
            $pemeriksaan = $this->index();
        }
        return DataTables::of($pemeriksaan)->make(true);
    }
}
