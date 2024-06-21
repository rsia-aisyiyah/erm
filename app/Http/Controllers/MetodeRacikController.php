<?php

namespace App\Http\Controllers;

use App\Models\MetodeRacik;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class MetodeRacikController extends Controller
{
    use JsonResponseTrait;

    function get(Request $request)
    {
        $metode = MetodeRacik::where('nm_racik', 'like', '%' . $request->metode . '%')->get();
        return $this->successResponse($metode);
    }
}
