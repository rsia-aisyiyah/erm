<?php

namespace App\Http\Controllers;

use App\Models\RsiaSkriningGizi;
use Illuminate\Http\Request;

class SkriningGiziController extends Controller
{
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }

    public function get(Request $request)
    {
        $no_rawat = $request->input('no_rawat');
        if (!$no_rawat) {
            return response()->json(['success' => false, 'message' => 'No. Rawat wajib diisi.'], 422);
        }

        $skrining = RsiaSkriningGizi::where('no_rawat', $no_rawat)->first();

        return response()->json([
            'success' => true,
            'data' => $skrining
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'bb' => 'required|numeric|min:0',
            'tb' => 'required|numeric|min:0',
            'diagnosa_medis' => 'required|string',
        ]);

        $no_rawat = $request->input('no_rawat');
        $bb = floatval($request->input('bb'));
        $tb = floatval($request->input('tb'));

        $tbMeter = $tb > 0 ? $tb / 100 : 0;
        $imt = $tbMeter > 0 ? round($bb / ($tbMeter * $tbMeter), 2) : 0;

        $kategori = strtoupper($request->input('kategori', 'ANAK'));

        $skor = 0;
        $keterangan = 'Resiko Rendah';

        if ($kategori === 'OBGYN') {
            $q_obgyn = $request->input('q_obgyn', 'TIDAK,TIDAK,TIDAK');
            $qParts = explode(',', $q_obgyn);
            $q1 = strtoupper(trim($qParts[0] ?? 'TIDAK'));
            $q3 = strtoupper(trim($qParts[1] ?? 'TIDAK'));
            $q4 = strtoupper(trim($qParts[2] ?? 'TIDAK'));

            if ($q1 === 'YA') $skor += 1;
            if ($q3 === 'YA') $skor += 1;
            if ($q4 === 'YA') $skor += 1;

            $cb_obgyn = $request->input('cb_obgyn', '-');
            if ($cb_obgyn !== '-' && !empty($cb_obgyn) && $cb_obgyn !== 'Tidak ada') {
                $skor += 1;
            }

            $keterangan = $skor >= 1 ? 'Asesmen Lanjut oleh Ahli Gizi' : 'Resiko Rendah';

        } else {
            // ANAK
            $q_anak = $request->input('q_anak', 'TIDAK,TIDAK');
            $qParts = explode(',', $q_anak);
            $q1 = strtoupper(trim($qParts[0] ?? 'TIDAK'));
            $q2 = strtoupper(trim($qParts[1] ?? 'TIDAK'));

            if ($q1 === 'YA') $skor += 1;
            if ($q2 === 'YA') $skor += 1;

            $cb_anak1 = $request->input('cb_anak1', '-');
            if ($cb_anak1 !== '-' && !empty($cb_anak1) && $cb_anak1 !== 'Tidak ada') {
                $skor += 1;
            }

            $cb_anak2 = $request->input('cb_anak2', '-');
            if ($cb_anak2 !== '-' && !empty($cb_anak2) && $cb_anak2 !== 'Tidak ada') {
                $skor += 2;
            }

            if ($skor == 0) {
                $keterangan = 'Resiko Rendah';
            } elseif ($skor >= 1 && $skor <= 3) {
                $keterangan = 'Resiko Sedang';
            } else {
                $keterangan = 'Resiko Tinggi';
            }
        }

        // Allow user override for keterangan if provided
        if ($request->filled('keterangan') && !empty($request->input('keterangan'))) {
            $keterangan = $request->input('keterangan');
        }

        $data = [
            'no_rawat' => $no_rawat,
            'bb' => $bb,
            'tb' => $tb,
            'imt' => $imt,
            'lila' => floatval($request->input('lila', 0)),
            'skor' => $skor,
            'keterangan' => $keterangan,
            'jenis_diet' => $request->input('jenis_diet', 'Diet Nasi'),
            'status_jenis_diet' => '0',
            'status_assesment_lanjut' => $request->input('status_assesment_lanjut', 'Belum'),
            'diagnosa_medis' => $request->input('diagnosa_medis', '-'),
            'hb' => floatval($request->input('hb', 0)),
            'hiv' => $request->input('hiv', 'Tidak Periksa'),
            'hbsag' => $request->input('hbsag', 'Tidak Periksa'),
            'syphilis' => $request->input('syphilis', 'Tidak Periksa'),
            'cb_obgyn' => $request->input('cb_obgyn', '-'),
            'cb_anak1' => $request->input('cb_anak1', '-'),
            'cb_anak2' => $request->input('cb_anak2', '-'),
            'kategori' => $kategori,
            'q_anak' => $request->input('q_anak', 'TIDAK,TIDAK'),
            'q_obgyn' => $request->input('q_obgyn', 'TIDAK,TIDAK,TIDAK'),
        ];

        try {
            $record = RsiaSkriningGizi::updateOrCreate(
                ['no_rawat' => $no_rawat],
                $data
            );

            return response()->json([
                'success' => true,
                'message' => 'Skrining gizi berhasil disimpan.',
                'data' => $record,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan skrining gizi: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function cetak(Request $request)
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        $no_rawat = $request->input('no_rawat');
        if (!$no_rawat) {
            abort(404, 'No Rawat tidak ditemukan.');
        }

        $no_rawat = str_replace('-', '/', $no_rawat);

        $skrining = RsiaSkriningGizi::where('no_rawat', $no_rawat)->first();
        if (!$skrining) {
            abort(404, 'Data Skrining Gizi belum diisi untuk pasien ini.');
        }

        $regPeriksa = \App\Models\RegPeriksa::with(['pasien', 'dokter', 'kamarInap.kamar.bangsal'])
            ->where('no_rawat', $no_rawat)
            ->first();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('content.print.skrining_gizi', [
            'data' => $skrining,
            'regPeriksa' => $regPeriksa,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('skrining_gizi_' . str_replace(['/', ' '], '_', $no_rawat) . '.pdf');
    }
}
