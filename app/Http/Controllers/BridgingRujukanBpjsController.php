<?php

namespace App\Http\Controllers;

use App\Models\BridgingRujukanBpjs;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BridgingRujukanBpjsController extends Controller
{

    protected $rujukan;
    protected $track;
    public function __construct()
    {
        $this->rujukan = new BridgingRujukanBpjs();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $data = $request->all();
        try {
            $rujukan = $this->rujukan->create($data);
            $this->track->create($this->track->insertSql($this->rujukan, $data));
            return response()->json($rujukan);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
}
