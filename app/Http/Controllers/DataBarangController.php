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

    public function index()
    {

        return view('content.databarang.table_databarang');

    }
    public function all(Request $request)
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

    function table(Request $request)
    {
        $databarang = DataBarang::where('status', '1')
            ->with(['kodeSatuan', 'golongan', 'kategori', 'jenis', 'industriFarmasi']);
        // render to datatable
        return DataTables()->of($databarang)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->where('nama_brng', 'like', '%' . $request->get('search')['value'] . '%');
                }
            })
            ->make(true);

    }
}
