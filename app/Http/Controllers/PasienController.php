<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use function PHPSTORM_META\map;

class PasienController extends Controller
{
    protected $pasien;
    public function __construct()
    {
        $this->pasien = new Pasien();
    }
    public function index()
    {
        return view('content.pasien.pencarian');
    }
    public function search(Request $request)
    {
        $pasien = [];
        if ($request->has('q')) {
            $pasien = Pasien::where('nm_pasien', 'like', '%' . $request->q . '%')
                ->orWhere('no_rkm_medis', 'like', '%' . $request->q . '%')
                ->get();
        }
        return response()->json($pasien);
    }
    public function ambil($no_rkm_medis)
    {
        $pasien = Pasien::where('no_rkm_medis', $no_rkm_medis)->with(['regPeriksa.resepObat.resepDokter.dataBarang', 'regPeriksa.resepObat.resepRacikan.detailRacikan.dataBarang'])->first();
        return response()->json($pasien);
    }
    function getAsmed($no_rkm_medis)
    {
        $pasien = $this->pasien->where('no_rkm_medis', $no_rkm_medis)->with(['regPeriksa.asmedRajalKandungan'])->first();

        foreach ($pasien->regPeriksa as $p) {
            $data = [];
            $arrAsmed = json_decode($p['asmedRajalKandungan']);
            if (!empty($arrAsmed)) {
                $data[] = $arrAsmed;
            }
        }
        return DataTables::of($data)->make(true);
    }
}
