<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    protected $dataBarang;
    protected $barang;
    public function __construct(DataBarang $dataBarang)
    {
        $this->dataBarang = $dataBarang;
        $this->barang = $this->dataBarang->semua();
    }
    public function index(Request $request)
    {
        $query = $this->barang;
        if ($request->nama) {
            $query = $query->where('nama_brng', 'like', '%' . $request->nama . '%');
        }

        $hasil = $query->get();

        return response()->json($hasil, 200);
    }
    public function cari(Request $request)
    {
        $hasil = $this->barang->where('nama_brng', 'like', $request->nama . '%')->limit(10)->with([
            'gudangBarang' => function ($q) {
                return $q
                    ->where('kd_bangsal', 'RM7')
                    ->sum('stok');
            }
        ])
            ->whereHas('gudangBarang', function ($q) {
                return $q->where('kd_bangsal', 'RM7');
            })->get();

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
                    'message' => 'Tidak menemukan obat/alkes',
                ], 404);
        }
        return $response;
    }

    function get(string $kode_brng)
    {
        $data = $this->barang
            ->where('kode_brng', $kode_brng)->first();

        return response()->json($data);
    }
}
