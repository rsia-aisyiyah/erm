<?php

namespace App\Http\Controllers;

use App\Models\PeriksaLab;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DetailPemeriksaanLab;

class LabController extends Controller
{
    public function petugas(Request $request)
    {
        $lab = PeriksaLab::where('no_rawat', $request->no_rawat)
            ->where('kd_jenis_prw', $request->kd_jenis_prw)->with(['petugas', 'dokter'])->first();
        return response()->json($lab);
    }
    public function ambil(Request $request)
    {
        // $lab = DetailPemeriksaanLab::where('no_rawat', $request->no_rawat)
        //     ->with('jnsPerawatanLab', 'regPeriksa.pasien', 'template', 'periksaLab.dokter', 'periksaLab.perujuk', 'periksaLab.petugas')
        //     ->orderBy('id_template', 'ASC')
        //     ->orderBy('tgl_periksa', 'DESC')
        //     ->orderBy('jam', 'DESC');

        // if ($request->pemeriksaan) {
        //     $lab->whereHas('template', function ($query) use ($request) {
        //         return $query->where('Pemeriksaan', 'like', '%' . $request->pemeriksaan . '%');
        //     });
        // }
        // return $lab->get();
        $lab = PeriksaLab::where('no_rawat', $request->no_rawat)->with(['petugas', 'dokter', 'jnsPerawatanLab', 'detail.template'])
            ->orderBy('tgl_periksa', 'DESC')
            ->get();
        return response()->json($lab);
    }

    function getDataTable(Request $request)
    {
        // return $request->kd_poli;

        if ($request->kd_poli == 'OPE') {
            $regPeriksa = RegPeriksa::where('no_rkm_medis', $request->no_rkm_medis)->orderBy('no_rawat', 'DESC')->limit(2)->with(
                ['detailPemeriksaanLab.template', 'detailPemeriksaanLab.jnsPerawatanLab', 'detailPemeriksaanLab.periksaLab.petugas']
            )->get();


            $data = [];
            foreach ($regPeriksa as $reg) {
                foreach ($reg->detailPemeriksaanLab as $detail) {
                    $data[] = $detail;
                }
            }
            return DataTables::of($data)->make(true);
        } else {
            $data = $this->ambil($request);
            return DataTables::of($data)->make(true);
        }
    }
}
