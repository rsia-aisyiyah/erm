<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CacatFisikController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\CacatFisik();
    }

    public function get(Request $request)
    {
        $cacat = $this->model;
        if ($request) {
            $cacat = $this->model->where('nama_cacat', 'like', '%' . $request->cacat . '%');
            return $cacat->get();
        }
        $cacat = $cacat->get();
        return response()->json($cacat, 200);
    }
}
