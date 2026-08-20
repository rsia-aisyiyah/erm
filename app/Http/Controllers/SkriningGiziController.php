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

        $kategori = $request->input('kategori', 'ANAK');
        $skor = intval($request->input('skor', 0));
        
        $keterangan = $request->input('keterangan', '');
        if (empty($keterangan)) {
            $keterangan = $skor >= 4 ? 'Resiko Tinggi' : ($skor >= 2 ? 'Resiko Sedang' : 'Resiko Rendah');
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
            'cb_obgyn' => $request->input('cb_obgyn', ''),
            'cb_anak1' => $request->input('cb_anak1', ''),
            'cb_anak2' => $request->input('cb_anak2', ''),
            'kategori' => $kategori,
            'q_anak' => $request->input('q_anak', ''),
            'q_obgyn' => $request->input('q_obgyn', ''),
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
}
