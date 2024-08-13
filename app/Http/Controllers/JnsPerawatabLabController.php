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
    function getTemplate(Request $request): JsonResponse
    {
        $data = JnsPerawatanLab::select(['kd_jenis_prw', 'nm_perawatan'])->whereIn('kd_jenis_prw', $request->kode)
            ->with('template', function ($query) use ($request) {
                if ($request->nm_perawatan) {
                    return $query = $query->where('nm_perawatan', 'like', "%{$request->nm_perawatan}%");
                }
                return $query;
            })->get();
        return response()->json($data);
    }
}
