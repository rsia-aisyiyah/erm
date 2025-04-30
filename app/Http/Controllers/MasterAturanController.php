<?php

namespace App\Http\Controllers;

use App\Models\MasterAturan;
use Illuminate\Http\Request;

class MasterAturanController extends Controller
{
    public function cari(Request $request)
    {
        $aturan = MasterAturan::where('aturan_pakai', 'like', '%' . $request->aturan . '%')->groupBy('aturan_pakai')->get();
        return response()->json($aturan);
    }
}
