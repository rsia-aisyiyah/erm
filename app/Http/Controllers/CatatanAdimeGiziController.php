<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanAdimeGiziRequest;
use App\Models\CatatanAdimeGizi;
use App\Services\Gizi\CatatanAdimeService;
use App\Traits\ResponseTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CatatanAdimeGiziController extends Controller
{
    use ResponseTrait;

    public function __construct(protected CatatanAdimeService $service)
    {

    }
    public function store(CatatanAdimeGiziRequest $request)
    {
        try {

            $data = $this->service->store(
                $request->validated()
            );

            return $this->successResponse(
                $data,
                'Data catatan ADIME gizi berhasil disimpan',
                201
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                'Gagal menyimpan data catatan ADIME gizi: ' . $e->getMessage(),
                500
            );
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
                return $this->successResponse($catatan, 'Data catatan ADIME gizi berhasil diambil', 200);
            } else {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengambil data catatan ADIME gizi: ' . $e->getMessage(), 500);
        }
    }
    public function delete(Request $request)
    {
        try {

            $this->service->delete(
                $request->no_rawat,
                $request->tanggal
            );

            return $this->successResponse(
                null,
                'Data catatan ADIME gizi berhasil dihapus',
                200
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                'error',
                'Gagal menghapus data catatan ADIME gizi: ' . $e->getMessage(),
                500
            );
        }
    }

    public function edit(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $tanggal = $request->tanggal;

        try {
            $catatan = CatatanAdimeGizi::where('no_rawat', $no_rawat)
                ->where('tanggal', $tanggal)
                ->first();
            if ($catatan) {
                return $this->successResponse($catatan, 'Data catatan ADIME gizi berhasil diambil untuk diedit', 200);
            } else {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengambil data catatan ADIME gizi untuk diedit: ' . $e->getMessage(), 500);
        }
    }

    public function update(CatatanAdimeGiziRequest $request)
    {
        try {

            $data = $this->service->update(
                $request->validated(),
                $request->tanggal2 // tanggal lama
            );

            return $this->successResponse(
                $data,
                'Data catatan ADIME gizi berhasil diubah',
                200
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                'Gagal mengubah data catatan ADIME gizi: ' . $e->getMessage(),
                500
            );
        }
    }
    public function print(Request $request)
    {
        try {

            $adime = $this->service->print(
                $request->no_rawat
            );

            $pdf = Pdf::loadView(
                'content.print.catatan_adime_gizi',
                compact('adime')
            )
                ->setOption([
                    'defaultFont' => 'serif',
                    'isRemoteEnabled' => true
                ])
                ->setPaper('A4');

            return $pdf->stream(
                $adime->first()->pasien->nm_pasien 
                . '_ADIME_'
                . date('YmdHis')
                . '.pdf'
            );

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }




}
