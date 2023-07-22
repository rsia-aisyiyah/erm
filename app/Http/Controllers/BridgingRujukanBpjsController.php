<?php

namespace App\Http\Controllers;

use App\Models\BridgingRujukanBpjs;
use Illuminate\Http\Request;

class BridgingRujukanBpjsController extends Controller
{

    protected $rujukan;
    public function __construct()
    {
        $this->rujukan = new BridgingRujukanBpjs();
    }
    function create(Request $request)
    {
        $data = $request->all();
        $rujukan = $this->rujukan->create($data);
        return response()->json($rujukan);
    }
}
