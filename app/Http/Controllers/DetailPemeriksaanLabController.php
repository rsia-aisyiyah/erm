<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaanLab;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailPemeriksaanLabController extends Controller
{
    protected DetailPemeriksaanLab $detailPemeriksaanLab;

    /**
     * Initializes a new instance of the DetailPemeriksaanLabController class.
     *
     * @param DetailPemeriksaanLab $detailPemeriksaanLab The DetailPemeriksaanLab instance to be used.
     * @return void
     */
    public function __construct(DetailPemeriksaanLab $detailPemeriksaanLab)
    {
        $this->detailPemeriksaanLab = $detailPemeriksaanLab;
    }
    /**
     * Retrieves the detail pemeriksaan lab data based on the provided no_rawat.
     *
     * @param Request $request The HTTP request containing the no_rawat parameter.
     * @return JsonResponse A JSON response containing the retrieved data.
     */
    function get(Request $request): JsonResponse
    {
        $data = $this->detailPemeriksaanLab
            ->where('no_rawat', $request->no_rawat)
            ->with('template')
            ->select('no_rawat', 'kd_jenis_prw', 'tgl_periksa', 'jam', 'id_template', 'nilai')
            ->get();

        return response()->json($data);
    }
}
