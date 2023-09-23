<?php

namespace App\Http\Controllers;

use App\Models\AturanPakai;
use App\Models\DetailPemberianObat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailPemberianObatController extends Controller
{
    public function aturanPakai(Request $request)
    {
        $aturan = AturanPakai::where('no_rawat', $request->no_rawat)
            ->where('kode_brng', $request->kode_brng)->first();
        return response()->json($aturan);
    }
    function get(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $obat = $request->obat;

        $pemberian = DetailPemberianObat::where('no_rawat', $no_rawat)->with(['databarang.kodeSatuan']);
        if ($obat) {
            $pemberian->whereHas('databarang', function ($query) use ($obat) {
                return $query->where('nama_brng', 'like', '%' . $obat . '%');
            });
        }

        return $pemberian->get();
    }
    function getDataTable(Request $request)
    {
        $data = $this->get($request);
        return DataTables::of($data)->make(true);
    }
}
