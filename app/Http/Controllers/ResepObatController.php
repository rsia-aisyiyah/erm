<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;

class ResepObatController extends Controller
{
    private $resepObat;
    public function __construct()
    {
        $this->resepObat = new ResepObat();
    }
    public function ambil()
    {
    }
    public function akhir(Request $request)
    {
        // return $request;
        $resepObat = $this->resepObat;

        if ($request->tgl_peresepan) {
            $result = $resepObat->where('tgl_peresepan', $request->tgl_peresepan)->orderBy('no_resep', 'DESC')->first();
        }

        return response()->json($result);
    }
}
