<?php

namespace App\Http\Controllers;

use App\Models\BridgingSep;
use App\Models\RegPeriksa;
use App\Models\RsiaRencanaKontrolRalan;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RsiaRencanaKontrolRalanController extends Controller
{
    /**
     * Ambil data rencana kontrol / disposisi ralan berdasarkan no_rawat.
     */
    public function get(Request $request): JsonResponse
    {
        $noRawat = $request->input('no_rawat');
        if (!$noRawat) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter no_rawat wajib diisi'
            ], 400);
        }

        try {
            $disposisi = RsiaRencanaKontrolRalan::where('no_rawat', $noRawat)
                ->with(['dokter', 'poliklinik', 'pegawai'])
                ->first();

            // Cek apakah ada SEP dan Surat Kontrol BPJS yang sudah terbit untuk pasien ini
            $sep = BridgingSep::where('no_rawat', $noRawat)
                ->with('suratKontrol')
                ->first();

            return response()->json([
                'success' => true,
                'data' => $disposisi,
                'sep' => $sep ? [
                    'no_sep' => $sep->no_sep,
                    'tglsep' => $sep->tglsep,
                    'no_kartu' => $sep->no_kartu,
                    'surat_kontrol' => $sep->suratKontrol ? [
                        'no_surat' => $sep->suratKontrol->no_surat,
                        'tgl_rencana' => $sep->suratKontrol->tgl_rencana,
                        'tgl_surat' => $sep->suratKontrol->tgl_surat,
                        'nm_dokter_bpjs' => $sep->suratKontrol->nm_dokter_bpjs,
                        'nm_poli_bpjs' => $sep->suratKontrol->nm_poli_bpjs,
                    ] : null,
                ] : null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data rencana kontrol: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simpan / perbarui disposisi rencana kontrol pasien rawat jalan.
     */
    public function simpan(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'status_tindak_lanjut' => 'required|in:KONTROL,SEMBUH,RUJUK_BALIK,RUJUK_LANJUT,RAWAT_INAP,KONSUL_SELESAI',
            'tgl_rencana_kontrol' => 'nullable|date',
            'kd_dokter' => 'nullable|string',
            'kd_poli' => 'nullable|string',
            'catatan' => 'nullable|string|max:255',
        ]);

        try {
            $noRawat = $request->no_rawat;
            $regPeriksa = RegPeriksa::where('no_rawat', $noRawat)->first();

            $kdDokter = $request->kd_dokter ?: ($regPeriksa ? $regPeriksa->kd_dokter : '-');
            $kdPoli = $request->kd_poli ?: ($regPeriksa ? $regPeriksa->kd_poli : null);
            $nip = session()->get('pegawai') ? session()->get('pegawai')->nik : null;

            $statusTindakLanjut = $request->status_tindak_lanjut;
            $tglRencanaKontrol = ($statusTindakLanjut === 'KONTROL') ? $request->tgl_rencana_kontrol : null;

            $disposisi = RsiaRencanaKontrolRalan::updateOrCreate(
                ['no_rawat' => $noRawat],
                [
                    'kd_dokter' => $kdDokter,
                    'kd_poli' => $kdPoli,
                    'status_tindak_lanjut' => $statusTindakLanjut,
                    'tgl_rencana_kontrol' => $tglRencanaKontrol,
                    'catatan' => $request->catatan ?: null,
                    'nip' => $nip,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Disposisi tindak lanjut berhasil disimpan.',
                'data' => $disposisi
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan rencana kontrol: ' . $e->getMessage()
            ], 500);
        }
    }
}
