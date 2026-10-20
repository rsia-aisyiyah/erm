<?php

namespace App\Http\Controllers;

use App\Models\TelaahFarmasi;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TelaahFarmasiController extends Controller
{
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }

    /**
     * Ambil data telaah farmasi berdasarkan no_resep / no_permintaan
     */
    public function get($no_resep): JsonResponse
    {
        $telaah = TelaahFarmasi::with('petugas')->where('no_resep', $no_resep)->first();

        return response()->json([
            'status' => true,
            'data' => $telaah,
        ]);
    }

    /**
     * Simpan atau update telaah farmasi (Telaah Resep & Verifikasi Obat)
     */
    public function simpan(Request $request): JsonResponse
    {
        $request->validate([
            'no_resep' => 'required',
        ]);

        $nip = $request->nip ?: (session()->get('pegawai')->nik ?? '-');

        $data = [
            'no_resep' => $request->no_resep,
            'resep_identifikasi_pasien' => $request->resep_identifikasi_pasien ?? 'Ya',
            'resep_ket_identifikasi_pasien' => substr($request->resep_ket_identifikasi_pasien ?? '-', 0, 30),
            'resep_tepat_obat' => $request->resep_tepat_obat ?? 'Ya',
            'resep_ket_tepat_obat' => substr($request->resep_ket_tepat_obat ?? '-', 0, 30),
            'resep_tepat_dosis' => $request->resep_tepat_dosis ?? 'Ya',
            'resep_ket_tepat_dosis' => substr($request->resep_ket_tepat_dosis ?? '-', 0, 30),
            'resep_tepat_cara_pemberian' => $request->resep_tepat_cara_pemberian ?? 'Ya',
            'resep_ket_tepat_cara_pemberian' => substr($request->resep_ket_tepat_cara_pemberian ?? '-', 0, 30),
            'resep_tepat_waktu_pemberian' => $request->resep_tepat_waktu_pemberian ?? 'Ya',
            'resep_ket_tepat_waktu_pemberian' => substr($request->resep_ket_tepat_waktu_pemberian ?? '-', 0, 30),
            'resep_ada_tidak_duplikasi_obat' => $request->resep_ada_tidak_duplikasi_obat ?? 'Ya',
            'resep_ket_ada_tidak_duplikasi_obat' => substr($request->resep_ket_ada_tidak_duplikasi_obat ?? '-', 0, 30),
            'resep_interaksi_obat' => $request->resep_interaksi_obat ?? 'Tidak',
            'resep_ket_interaksi_obat' => substr($request->resep_ket_interaksi_obat ?? '-', 0, 30),
            'resep_kontra_indikasi_obat' => $request->resep_kontra_indikasi_obat ?? 'Tidak',
            'resep_ket_kontra_indikasi_obat' => substr($request->resep_ket_kontra_indikasi_obat ?? '-', 0, 30),
            'obat_tepat_pasien' => $request->obat_tepat_pasien ?? 'Ya',
            'obat_tepat_obat' => $request->obat_tepat_obat ?? 'Ya',
            'obat_tepat_dosis' => $request->obat_tepat_dosis ?? 'Ya',
            'obat_tepat_cara_pemberian' => $request->obat_tepat_cara_pemberian ?? 'Ya',
            'obat_tepat_waktu_pemberian' => $request->obat_tepat_waktu_pemberian ?? 'Ya',
            'nip' => $nip,
        ];

        try {
            $isExist = TelaahFarmasi::where('no_resep', $request->no_resep)->exists();

            $telaah = TelaahFarmasi::updateOrCreate(
                ['no_resep' => $request->no_resep],
                $data
            );

            if (!$isExist) {
                $this->track->insertSql(new TelaahFarmasi(), $data);
            }

            return response()->json([
                'status' => true,
                'message' => 'Hasil Telaah Farmasi berhasil disimpan',
                'data' => $telaah,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan telaah farmasi: ' . $e->getMessage(),
            ], 500);
        }
    }
}
