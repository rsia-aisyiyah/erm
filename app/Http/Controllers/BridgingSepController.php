<?php

namespace App\Http\Controllers;

use App\Action\FilterBridgingSep;
use App\DataTables\BridgingSepDataTable;
use App\Models\BridgingSep;
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

        return view('content.sep.index');
    }

    function filter(FilterBridgingSep $action, Request $request)
    {

        $filter = $action->handle($this->sep, $request->all());
        return $filter;

    }

    function ambilSep($no_sep)
    {
        $sep = $this->sep->where('no_sep', $no_sep)->with(['regPeriksa.pasien.sep', 'suratKontrol', 'regPeriksa.dokter', 'rujukanKeluar'])->first();
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
