<?php

namespace App\Http\Controllers;

use App\Models\ResepPulang;
use Illuminate\Http\Request;

class ResepPulangController extends Controller
{
    public function get(Request $request)
    {
        $query = ResepPulang::where('no_rawat', $request->no_rawat)
            ->with('obat', function ($query) {
                return $query->select(['kode_brng', 'nama_brng']);
            })
            ->get();
        return response()->json($query);
    }
}
