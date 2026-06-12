<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAskepRalanKebidananRequest;
use App\Models\AskepRalanKebidanan;
use App\Traits\PrintErmTrait;
use App\Traits\ResponseTrait;
use App\Traits\TrackSQL;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class AskepRalanKebidananController extends Controller
{
    use ResponseTrait, PrintErmTrait;
    private $track;
    private $askep;
    public function __construct()
    {
        $this->askep = new AskepRalanKebidanan();
        $this->track = new TrackerSqlController();
    }
    public function ambil(Request $request)
    {
        $askep = $this->askep->semua();

        if ($request->no_rawat) {
            $askep->where('no_rawat', $request->no_rawat);
        }
        if ($request->no_rkm_medis) {
            $askep->whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('no_rkm_medis', $request->no_rkm_medis);
            });
        }
        if ($request->petugas) {
            $askep->where('nip', $request->petugas);
        }

        if ($askep->count() > 0) {
            $response = response()->json(['success' => true, 'message' => 'Menampilkan data asesmen keperawatan awal', 'data' => $askep->orderBy('tanggal', 'DESC')->get()], 200);
        } else {
            $response = response()->json(['success' => false, 'message' => 'Tidak ada data yang ditemukan', 'data' => NULL], 200);
        }
        return $response;
    }
    function get($noRawat)
    {
        $noRawat = str_replace('-', '/', $noRawat);
        $askep = $this->askep->semua()->where('no_rawat', $noRawat)->first();
        return response()->json($askep);
    }
    public function getFirst(Request $request)
    {
        $data = $this->askep
            ->with(['pasien', 'riwayatPersalinan', 'petugas'])
            ->where('no_rawat', $request->no_rawat)
            ->first();
        return $this->successResponse($data);
    }

    public function store(StoreAskepRalanKebidananRequest $request)
    {
        $data = $request->validated();
        // $sessionNik = session()->get('pegawai')->nik;
        // // 1. Cari apakah data sudah ada
        // $existingAskep = $this->askep->find($data['no_rawat']);

        // // 2. Validasi Khusus Update:
        // // Jika data sudah ada, pastikan session NIK sama dengan NIK di database
        // if ($existingAskep && $sessionNik !== $existingAskep->nip) {
        //     throw ValidationException::withMessages([
        //         'nip' => ['Anda tidak memiliki akses untuk mengubah data ini. Hubungi perawat penanggung jawab pasien.'],
        //     ]);
        // }

        try {
            $askep = $this->askep->updateOrCreate(
                ['no_rawat' => $data['no_rawat']],
                $data
            );

            $this->track->insertSql($this->askep, $data);

            return $this->successResponse(
                $askep,
                $askep->wasRecentlyCreated ? 'Data berhasil disimpan' : 'Data berhasil diperbarui'
            );
        } catch (QueryException $e) {
            return $this->errorResponse($e, 'Gagal menyimpan data '. $e->errorInfo[2]);

        }
    }
    // public function print(Request $request)
    // {
    //     $data = $this->askep
    //         ->with([
    //             'pasien',
    //             'petugas',
    //             'riwayatPersalinan'
    //         ])
    //         ->where('no_rawat', $request->no_rawat)
    //         ->firstOrFail();

    //     $data->ttd_petugas = $this->setFingerOutput(
    //         $data->petugas->nama ?? '-',
    //         $data->nip,
    //         $data->tanggal
    //     );

    public function print(Request $request)
    {
        $data = $this->askep
            ->with([
                'pasien',
                'petugas',
                'riwayatPersalinan'
            ])
            ->where('no_rawat', $request->no_rawat)
            ->firstOrFail();

        $data->ttd_petugas = $this->setFingerOutput(
            $data->petugas->nama ?? '-',
            $data->nip,
            $data->tanggal
        );

        $pdf = Pdf::loadView(
            'content.poliklinik.modal.pemeriksaan.print.askep_awal_obgyn',
            compact('data')
        )
            ->setOption([
                'defaultFont' => 'sans-serif',
                'isRemoteEnabled' => true,
                'margin_top' => 15,
                'margin_right' => 15,
                'margin_bottom' => 15,
                'margin_left' => 15,
                'margin_header' => 5,   // tambahkan ini
                'margin_footer' => 5,   // tambahkan ini
            ])
            // ->setOption([
            //     'defaultFont' => 'serif',
            //     '
            // ])
            ->setPaper('A4');

        return $pdf->stream(
            ($data->pasien->nm_pasien ?? 'pasien')
                . '_ASKEP_KEBIDANAN_'
                . now()->format('YmdHis')
                . '.pdf'
        );
    }
}
