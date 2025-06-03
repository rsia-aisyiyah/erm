<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function index()
    {
        return view('content.ugd.ugd');
    }

    public function getTable(Request $request)
    {
        $regPeriksa = $this->regPeriksa
            ->select(
                DB::raw('TRIM(kd_dokter) as kd_dokter'),
                DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
                DB::raw('TRIM(kd_pj) as kd_pj'),
                'no_rawat',
                'tgl_registrasi',
                'jam_reg',
                'status_bayar',
                'status_poli',
                'stts_daftar',
                'no_rawat',
                'umurdaftar',
                'sttsumur',
                'status_lanjut',
                'stts'
            )
            ->with(['pasien', 'sep', 'dokter.mappingDokter', 'kamarInap', 'penjab', 'asmedRanapAnak', 'asmedRanapKandungan', 'asmedIgd', 'skriningTb', 'triaseSkala1', 'triaseSkala2', 'triaseSkala3', 'triaseSkala4', 'triaseSkala5'])->where('kd_poli', 'IGDK');

        if ($request->tgl_awal || $request->tgl_akhir) {
            $regPeriksa->whereBetween('tgl_registrasi', [$request->tgl_awal, $request->tgl_akhir])->get();
        } else {
            $regPeriksa->where('tgl_registrasi', date('Y-m-d'))->get();
        }

        if ($request->nm_pasien) {
            $regPeriksa->whereHas('pasien', function ($q) use ($request) {
                return $q->where('nm_pasien', 'like', "%$request->nm_pasien%");
            })->get();
        }

        if ($request->spesialis) {
            $regPeriksa->whereHas('dokter', function ($q) use ($request) {
                return $q->where('kd_sps', $request->spesialis);
            })->get();
        }
        if ($request->kd_dokter) {
            $regPeriksa->where('kd_dokter', $request->kd_dokter)->get();
        }

        return DataTables::of($regPeriksa)->make(true);
    }
}
