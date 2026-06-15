<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAskepRalanAnakRequest;
use App\Models\AskepRalanAnak;
use App\Models\MasalahAskepRalanAnak;
use App\Models\RencanaAskepRalanAnak;
use App\Services\MasalahRencanaKeperawatanService;
use App\Traits\FingerPrintTrait;
use App\Traits\ResponseTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AskepRalanAnakController extends Controller
{
    use ResponseTrait, FingerPrintTrait;
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
            $askep = AskepRalanAnak::where('no_rawat', $request->no_rawat)
                ->with(['masalah', 'rencanaMasalah'])
                ->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')
                ->first();
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
    public function print(Request $request)
    {
        $data = AskepRalanAnak::with([
            'pasien',
            'petugas',
            'riwayatImunisasi',
            'masalah',
            'rencanaMasalah',
        ])
            ->where('no_rawat', $request->no_rawat)
            ->firstOrFail();

        $data->ttd_petugas = $this->setFingerOutput(
            $data->petugas->nama ?? '-',
            $data->nip,
            $data->tanggal
        );

        $pdf = Pdf::loadView(
            'content.print.askep_ralan_anak',
            compact('data')
        )
            ->setOption([
                'defaultFont' => 'sans-serif',
                'isRemoteEnabled' => true,
                'margin_top' => 10,
                'margin_right' => 10,
                'margin_bottom' => 10,
                'margin_left' => 10,
                'margin_header' => 5,
                'margin_footer' => 5,
            ])
            ->setPaper('A4');

        return $pdf->stream(
            ($data->pasien->nm_pasien ?? 'pasien')
            . '_ASKEP_AWAL_ANAK_'
            . now()->format('YmdHis')
            . '.pdf'
        );
    }
}
