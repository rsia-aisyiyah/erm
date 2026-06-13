<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAskepRalanAnakRequest;
use App\Models\AskepRalanAnak;
use App\Models\MasalahAskepRalanAnak;
use App\Models\RencanaAskepRalanAnak;
use App\Services\MasalahRencanaKeperawatanService;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AskepRalanAnakController extends Controller
{
    use ResponseTrait;
    public function ambil(Request $request)
    {
        if ($request->no_rkm_medis) {
            $askep = AskepRalanAnak::whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('no_rkm_medis', $request->no_rkm_medis);
            })->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->get();
        }

        if ($request->no_rawat) {
            $askep = AskepRalanAnak::where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->get();
        }

        return response()->json($askep);
    }
    public function ambilDetail(Request $request)
    {
        if ($request->no_rawat) {
            $askep = AskepRalanAnak::where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->first();
        }
        return response()->json($askep);
    }
    public function store(StoreAskepRalanAnakRequest $request, MasalahRencanaKeperawatanService $service)
    {
        $data = $request->validated();
        $no_rawat = $data['no_rawat'];

        $masalah = $request->input('checkMasalahKeperawatan', []);

        $rencana = $request->input('checkRencanaKeperawatan', []);

        try {
            DB::transaction(function () use ($data, $no_rawat, $service, $masalah, $rencana) {

                AskepRalanAnak::updateOrCreate(
                    ['no_rawat' => $no_rawat],
                    $data
                );
                $service->masalah($no_rawat, $masalah, MasalahAskepRalanAnak::class);
                $service->rencana($no_rawat, $rencana, RencanaAskepRalanAnak::class);
            });

            return $this->successResponse('Data askep ralan anak berhasil disimpan');
        } catch (QueryException $e) {
            return $this->errorResponse(
                'Gagal menyimpan data askep ralan anak: ' . $e->getMessage(),
                500
            );
        }
    }
}
