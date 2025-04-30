<?php

namespace App\Http\Controllers;

use App\Models\BahasaPasien;
use Illuminate\Http\Request;

class BahasaPasienController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new BahasaPasien();
    }

    public function get(Request $request)
    {
        $bahasa = $this->model;
        if ($request) {
            $bahasa = $this->model->where('nama_bahasa', 'like', '%' . $request->bahasa . '%');
            return $bahasa->get();
        }
        $bahasa = $bahasa->get();
        return response()->json($bahasa, 200);
    }
}
