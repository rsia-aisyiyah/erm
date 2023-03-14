<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    private $dataBarang, $data;
    public function __construct()
    {
        $this->dataBarang = new DataBarang();
        $this->data = $this->dataBarang->semua();
    }
    public function index()
    {
        $hasil = $this->data->get();
        return response()->json($hasil, 200);
    }
    public function cari(Request $request)
    {
        $hasil = $this->data->where('kdjns', '!=', 'J024')->where('nama_brng', 'like', '%' . $request->nama . '%')->with(['gudangBarang' => function ($q) {
            return $q
                ->where('kd_bangsal', 'RM7')
                ->sum('stok');
        }])->get();

        if ($hasil) {
            $response =
                response()->json([
                    'success' => true,
                    'message' => 'Data obat dan alkes berdasarkan pencarian = ' . $request->nama,
                    'data' => $hasil,
                ], 200);
        } else {
            $response =
                response()->json([
                    'success' => false,
                    'message' => 'Tidak menemukan obat/alkes'
                ], 404);
        }
        return $response;
    }
}
