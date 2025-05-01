<?php

namespace App\Http\Controllers;

use App\Models\SukuBangsa;
use Illuminate\Http\Request;

class SukuBangsaController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new SukuBangsa();
    }

    public function get(Request $request)
    {
        $suku = $this->model;
        if ($request) {
            $suku = $this->model->where('nama_suku_bangsa', 'like', '%' . $request->nama . '%');
            return $suku->get();
        }
        $suku = $suku->get();
        return response()->json($suku, 200);
    }
}
