<?php

namespace App\Http\Controllers;

use App\Action\FilterBridgingSep;
use App\DataTables\BridgingSepDataTable;
use App\Models\BridgingSep;
use App\Models\Dokter;
use App\Models\Poliklinik;
use Carbon\Carbon;
use DeepCopy\Filter\Filter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BridgingSepController extends Controller
{
    private $sep;
    public function __construct()
    {
        $this->sep = new BridgingSep();
    }

    function index()
    {
        $poliklinik = Poliklinik::where('status', '1')->where('kd_poli', '!=', '-')->orderBy('nm_poli')->get();
        $dokter = Dokter::where('status', '1')->where('kd_dokter', '!=', '-')->orderBy('nm_dokter')->get();
        return view('content.sep.index', compact('poliklinik', 'dokter'));
    }

    function filter(FilterBridgingSep $action, Request $request)
    {

        $filter = $action->handle($this->sep, $request->all());
        return $filter;

    }

    function countSummary(FilterBridgingSep $action, Request $request)
    {
        $base = $action->handle(new BridgingSep(), $request->except('status_skrj'));

        $total = (clone $base)->count();

        $flaggedKontrol = (clone $base)->whereHas('regPeriksa.rencanaKontrolRalan', function ($query) {
            $query->where('status_tindak_lanjut', 'KONTROL');
        });
        $countFlagged = (clone $flaggedKontrol)->count();

        $countTerbit = (clone $base)->has('suratKontrol')->count();

        $countBelum = (clone $flaggedKontrol)->doesntHave('suratKontrol')->count();

        return response()->json([
            'total' => $total,
            'flagged' => $countFlagged,
            'terbit' => $countTerbit,
            'belum' => $countBelum,
        ]);
    }

    function ambilSep($no_sep)
    {
        $sep = $this->sep->where('no_sep', $no_sep)->with(['regPeriksa.pasien.sep', 'suratKontrol', 'regPeriksa.dokter', 'rujukanKeluar', 'regPeriksa.rencanaKontrolRalan'])->first();
        return response()->json($sep);
    }

    function dataTable(FilterBridgingSep $action, Request $request)
    {
        $filter = $action->handle(new BridgingSep(), $request->all());
        return DataTables::of($filter)
            ->editColumn('tglsep', function ($data) {
                return Carbon::parse($data->tglsep)->translatedFormat('d F Y');
            })->filter(function ($query) use ($request) {
                if ($request->get('search')['value']) {
                    $query->where('nama_pasien', 'like', '%' . $request->get('search')['value'] . '%')
                        ->orWhere('no_sep', 'like', '%' . $request->get('search')['value'] . '%')
                        ->orWhere('no_rawat', 'like', '%' . $request->get('search')['value'] . '%')
                        ->orWhere('no_kartu', 'like', '%' . $request->get('search')['value'] . '%');
                }
            })
            ->make(true);
    }
}
