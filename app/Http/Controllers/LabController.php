<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaanLab;
use App\Models\PeriksaLab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function petugas(Request $request)
    {
        $lab = PeriksaLab::where('no_rawat', $request->no_rawat)
            ->where('kd_jenis_prw', $request->kd_jenis_prw)->with(['petugas', 'dokter'])->first();
        return response()->json($lab);
    }
    public function ambil(Request $request)
    {
        $lab = DetailPemeriksaanLab::where('no_rawat', $request->no_rawat)
            ->with('jnsPerawatanLab', 'regPeriksa.pasien', 'template', 'periksaLab.dokter', 'periksaLab.perujuk', 'periksaLab.petugas')
            ->orderBy('tgl_periksa', 'DESC')
            ->orderBy('jam', 'DESC');

        if ($request->pemeriksaan) {
            $lab->whereHas('template', function ($query) use ($request) {
                return $query->where('Pemeriksaan', 'like', '%' . $request->pemeriksaan . '%');
            });
        }
        return response()->json($lab->get());
    }
}
