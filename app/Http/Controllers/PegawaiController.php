<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function ambil(Request $request)
    {
        $pegawai = Pegawai::where('nik', $request->nik)->first();

        return response()->json($pegawai);
    }
}
