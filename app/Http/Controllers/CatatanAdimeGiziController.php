<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanAdimeGiziRequest;
use App\Models\CatatanAdimeGizi;
use Exception;
use Illuminate\Http\Request;

class CatatanAdimeGiziController extends Controller
{
    public function store(CatatanAdimeGiziRequest $request)
    {
        // 1. Validasi Input sesuai tipe data di DB
        $validated = $request->validated();
        try {
            CatatanAdimeGizi::create($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Data Adime Gizi berhasil disimpan!'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function get(Request $request)
    {
        $no_rawat = $request->query('no_rawat');
        try {

            $catatan = CatatanAdimeGizi::where('no_rawat', $no_rawat)
            ->with(['petugas', 'pasien', 'regPeriksa', 'kamarInap'])
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();


            if ($catatan) {
                return response()->json([
                    'status' => 'success',
                    'data' => $catatan
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }
}
