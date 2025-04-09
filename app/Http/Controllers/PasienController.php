<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $pasien = Pasien::where('no_rkm_medis', $no_rkm_medis)->with(['regPeriksa.resepObat.resepDokter.dataBarang', 'regPeriksa.resepObat.resepRacikan.detailRacikan.dataBarang'])
            ->with(['sukuBangsa', 'bahasa', 'cacat', 'penjab', 'kel', 'kec', 'kab', 'prop'])
            ->first();
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
    function table(Request $request)
    {
        $key = $request->search['value'];
        $pasien = $this->pasien;
        if ($key) {
            $pasien = $pasien
                ->where('nm_pasien', 'like', '%' . $key . '%');
        } else {
            $pasien = $pasien
                ->where('nm_pasien', '!=', '-')
                ->orderBy('nm_pasien', 'ASC');
        }
        $pasien = $pasien
            ->with('kec', 'kab', 'kel', 'penjab', 'instansi', 'prop')
            ->limit(1000)->get();
        return DataTables::of($pasien)
            ->addColumn('id', function ($pasien) {
                return Crypt::encrypt($pasien->no_rkm_medis);
            })
            ->make(true);
    }
}
