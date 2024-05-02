<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JnsPerawatanLab;
use Illuminate\Http\JsonResponse;

class JnsPerawatabLabController extends Controller
{
    function get(Request $request): JsonResponse
    {
        $data = JnsPerawatanLab::where('status', '1')
            ->where('nm_perawatan', 'like', "%{$request->nm_perawatan}%")->get();
        return response()->json($data);
    }
}
