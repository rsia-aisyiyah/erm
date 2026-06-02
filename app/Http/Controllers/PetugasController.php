<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function cari(Request $request)
    {

        $petugas = Petugas::join('pegawai', 'pegawai.nik', '=', 'petugas.nip')
            ->join('departemen', 'departemen.dep_id', '=', 'pegawai.departemen')
            ->select('petugas.nip', 'petugas.nama', 'departemen.nama as departemen', 'petugas.status')
            ->where('departemen', '!=', '-')
            ->orderBy('petugas.nama', 'ASC');
        $hasil = '';
        if ($request->has('q')) {
            $hasil = $petugas->where('petugas.nama', 'like', '%' . $request->q . '%')
                ->where('status', '1')->limit(10)->get();
        } else {
            $hasil = $petugas->where('status', '1')->limit(10)->get();
        }

        return response()->json($hasil);
    }
}
