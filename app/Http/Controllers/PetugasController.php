<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function cari(Request $request)
    {

        $petugas = new Petugas();
        $hasil = '';
        if ($request->has('q')) {
            $hasil = $petugas->where('nama', 'like', '%' . $request->q . '%')
                ->where('status', '1')->limit(10)->get();
        } else {
            $hasil = $petugas->where('status', '1')->limit(10)->get();
        }

        return response()->json($hasil);
    }
}
