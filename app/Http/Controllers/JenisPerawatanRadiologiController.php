<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPerawatanRadiologi;

class JenisPerawatanRadiologiController extends Controller
{
    function get(Request $request)
    {
        $jenisPerawatanRadiologi = JenisPerawatanRadiologi::where('status', "1")
            ->where('nm_perawatan', 'like', "%{$request->key}%")->get();
        return response()->json($jenisPerawatanRadiologi);
    }
}
