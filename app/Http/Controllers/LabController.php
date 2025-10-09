<?php

namespace App\Http\Controllers;

use App\Models\PeriksaLab;
use App\Models\PermintaanLab;
use App\Models\RegPeriksa;
use App\Traits\ResponseTrait;
use App\Traits\TrackSQL;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DetailPemeriksaanLab;

class LabController extends Controller
{
	Use ResponseTrait;
    function index()
    {
        return view('content.lab.permintaan');
    }
    public function petugas(Request $request)
    {
        $lab = PeriksaLab::where('no_rawat', $request->no_rawat)
            ->where('kd_jenis_prw', $request->kd_jenis_prw)->with(['petugas', 'dokter'])->first();
        return response()->json($lab);
    }
    public function ambil(Request $request)
    {
        $lab = PeriksaLab::where('no_rawat', $request->no_rawat)
            ->with(['permintaan', 'petugas', 'dokter', 'perujuk', 'jnsPerawatanLab', 'detail.template'])
            ->where('kd_jenis_prw', '!=', "J000019")
            ->orderBy('tgl_periksa', 'DESC')
            ->orderBy('jam', 'ASC');
        if ($request->tgl_periksa && $request->jam) {
            $lab = $lab->where('tgl_periksa', $request->tgl_periksa)
                ->where('jam', $request->jam);
        }
        $lab = $lab->get();
        return response()->json($lab);
    }

	function getRiwayatLaboratorium($no_rkm_medis){
		$lab = PermintaanLab::whereHas('regPeriksa', function($q) use($no_rkm_medis){
			$q->where('no_rkm_medis', $no_rkm_medis);
		})
			->groupBy('no_rawat')
			->orderBy('no_rawat', 'DESC')
		->get();

		return $this->successResponse($lab);
	}
    function getDataTable(Request $request)
    {
        $lab = DetailPemeriksaanLab::where('no_rawat', $request->no_rawat)
            ->with('jnsPerawatanLab', 'regPeriksa.pasien', 'template', 'periksaLab.dokter', 'periksaLab.perujuk', 'periksaLab.petugas')
            ->orderBy('id_template', 'ASC')
            ->orderBy('tgl_periksa', 'DESC')
            ->orderBy('jam', 'DESC');

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
            return DataTables::of($lab)->make(true);
        }
    }
}
