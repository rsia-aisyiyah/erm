<?php

namespace App\Http\Controllers;

use App\Models\AskepRalanKebidanan;
use Illuminate\Http\Request;
use PDO;

class AskepRalanKebidananController extends Controller
{
    private $askep;
    public function __construct()
    {
        $this->askep = new AskepRalanKebidanan();
    }
    public function ambil(Request $request)
    {
        $askep =  $this->askep->semua();

        if ($request->no_rkm_medis) {
            $askep->whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('no_rkm_medis', $request->no_rkm_medis);
            });
        }
        if ($request->petugas) {
            $askep->where('nip', $request->petugas);
        }

        if ($askep->count() > 0) {
            $response = response()->json(['success' => true, 'message' => 'Menampilkan data asesmen keperawatan awal', 'data' => $askep->get()], 200);
        } else {
            $response = response()->json(['success' => false, 'message' => 'Tidak ada data yang ditemukan', 'data' => NULL], 404);
        }
        return $response;
    }
}
