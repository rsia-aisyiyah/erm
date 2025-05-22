<?php

namespace App\Http\Controllers;

use App\Models\SaranKesanLab;
use App\Services\Lab\SaranKesanLabService;
use App\Traits\TrackSQL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranKesanLabController extends Controller
{
    public $saranService;
    public function __construct(SaranKesanLabService $saranService)
    {
        $this->saranService = $saranService;
    }
    public function get(Request $request)
    {
        $data = $this->saranService->get($request);
        return response()->json($data);
    }

    public function show(Request $request)
    {
        $data = $this->saranService->show($request);
        return response()->json($data);
    }
    public function create(Request $request)
    {
        $data = $this->saranService->create($request);
        return response()->json('success', 202);
    }

    public function update(Request $request)
    {
        $data = $this->saranService->update($request);
        return response()->json('updated', 201);
    }

    public function destroy(Request $request)
    {
        $data = $this->saranService->delete($request);
        return response()->json('deleted', 200);
    }



}
