<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjabController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\Penjab();
    }
    function get(Request $request)
    {
        $penjab = $this->model;
        if ($request) {
            $penjab = $this->model
                ->where('status', '1')
                ->where('png_jawab', 'like', '%' . $request->penjab . '%');
            return $penjab->get();
        }
        $penjab = $penjab->get();
        return response()->json($penjab, 200);
    }
}
