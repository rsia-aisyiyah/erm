<?php

namespace App\Http\Controllers;

use App\Services\Lab\SaranKesanLabService;
use Illuminate\Http\Request;

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

}
