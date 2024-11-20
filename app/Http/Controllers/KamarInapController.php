<?php

namespace App\Http\Controllers;

use App\Models\KamarInap;
use Illuminate\Http\Request;

class KamarInapController extends Controller
{
    public function get(Request $request)
    {
        $query = KamarInap::where('no_rawat', $request->no_rawat)->get();
        return response()->json($query);

    }
}
