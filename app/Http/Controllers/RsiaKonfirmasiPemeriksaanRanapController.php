<?php

namespace App\Http\Controllers;

use App\Models\RsiaKonfirmasiPemeriksaanRanap;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RsiaKonfirmasiPemeriksaanRanapController extends Controller
{
    public function detail(Request $request)
    {
        $key = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam
        ];

        $first = RsiaKonfirmasiPemeriksaanRanap::where($key)->first();

        return response()->json($first);


    }
    public function create(Request $request)
    {
        $key = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];

        $data = array_merge($request->all(), [
            'petugas' => session()->get('pegawai')->nik,
            'tgl_konfirmasi' => date('Y-m-d H:i:s'),
            'jam_konfirmasi' => date('H:i:s'),
        ]);

        try {
            $update = RsiaKonfirmasiPemeriksaanRanap::updateOrCreate($key, $data);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json($update);
    }
}
