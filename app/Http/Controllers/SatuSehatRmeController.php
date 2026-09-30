<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\RegPeriksa;
use App\Services\SatuSehat\SatuSehatRmeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SatuSehatRmeController extends Controller
{
    protected SatuSehatRmeService $rmeService;

    public function __construct(SatuSehatRmeService $rmeService)
    {
        $this->rmeService = $rmeService;
    }

    /**
     * Buka RME SATUSEHAT untuk pasien berdasarkan no_rawat.
     */
    public function openRme(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'kd_dokter' => 'nullable|string',
        ]);

        try {
            $regPeriksa = RegPeriksa::with(['pasien', 'dokter.pegawai'])
                ->where('no_rawat', $request->no_rawat)
                ->first();

            if (!$regPeriksa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data registrasi pasien tidak ditemukan.',
                ], 404);
            }

            $pasien = $regPeriksa->pasien;
            if (!$pasien) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data rekam medis pasien tidak ditemukan.',
                ], 404);
            }

            // Dapatkan Data Dokter
            $dokter = null;
            if ($request->filled('kd_dokter')) {
                $dokter = Dokter::with('pegawai')->where('kd_dokter', $request->kd_dokter)->first();
            }
            if (!$dokter) {
                $dokter = $regPeriksa->dokter;
            }

            if (!$dokter) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data dokter pemeriksa tidak ditemukan.',
                ], 404);
            }

            // Validasi NIK Pasien
            $nikPasien = trim($pasien->no_ktp ?? '');
            if (empty($nikPasien) || strlen($nikPasien) < 16) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIK Pasien belum diisi atau tidak valid (harus 16 digit). Silakan periksa data kependudukan pasien di Master Pasien.',
                ], 422);
            }

            // Validasi NIK Dokter
            $nikDokter = trim($dokter->pegawai->no_ktp ?? $dokter->kd_dokter ?? '');
            if (empty($nikDokter)) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIK Dokter belum terdaftar pada data kepegawaian.',
                ], 422);
            }

            // Resolusi ID SATUSEHAT
            $patientId = $this->rmeService->getPatientIdByNik($nikPasien);
            $practitionerId = $this->rmeService->getPractitionerIdByNik($nikDokter);

            $payload = [
                'patient_id' => $patientId,
                'patient_name' => $pasien->nm_pasien,
                'practitioner_id' => $practitionerId,
                'practitioner_name' => $dokter->nm_dokter,
            ];

            // 1. Coba Buka SHLink (National RME Viewer)
            $shlResult = $this->rmeService->generateShlink($payload);

            if ($shlResult['status'] === 'success') {
                return response()->json([
                    'success' => true,
                    'status' => 'ready',
                    'shlink_url' => $shlResult['shlink_url'],
                    'patient_name' => $pasien->nm_pasien,
                    'practitioner_name' => $dokter->nm_dokter,
                    'message' => 'Tautan RME Nasional berhasil dibuka.',
                ]);
            }

            // 2. Jika Consent Diperlukan (HTTP 403), Otomatis Buat CHLink untuk Verifikasi Pasien
            if ($shlResult['status'] === 'consent_required') {
                $chlResult = $this->rmeService->generateChlink($payload);

                if ($chlResult['status'] === 'success') {
                    return response()->json([
                        'success' => true,
                        'status' => 'consent_required',
                        'verification_url' => $chlResult['verification_url'],
                        'expired_at' => $chlResult['expired_at'],
                        'patient_name' => $pasien->nm_pasien,
                        'message' => 'Persetujuan (Consent) pasien diperlukan untuk melihat rekam medis SATUSEHAT. Silakan minta pasien melakukan verifikasi.',
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'status' => 'consent_required',
                    'message' => 'Persetujuan pasien diperlukan, namun gagal membuat link verifikasi: ' . ($chlResult['message'] ?? 'Unknown error'),
                ], 400);
            }

            return response()->json([
                'success' => false,
                'message' => $shlResult['message'] ?? 'Gagal mengakses RME SATUSEHAT.',
                'raw' => $shlResult['raw'] ?? null,
            ], 400);

        } catch (Exception $e) {
            Log::error('SatuSehatRmeController Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Minta ulang tautan persetujuan (Consent Health Link).
     */
    public function requestConsent(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'kd_dokter' => 'nullable|string',
        ]);

        try {
            $regPeriksa = RegPeriksa::with(['pasien', 'dokter.pegawai'])
                ->where('no_rawat', $request->no_rawat)
                ->firstOrFail();

            $pasien = $regPeriksa->pasien;
            $dokter = $request->filled('kd_dokter')
                ? Dokter::with('pegawai')->where('kd_dokter', $request->kd_dokter)->first()
                : $regPeriksa->dokter;

            $patientId = $this->rmeService->getPatientIdByNik($pasien->no_ktp);
            $practitionerId = $this->rmeService->getPractitionerIdByNik($dokter->pegawai->no_ktp ?? $dokter->kd_dokter);

            $chlResult = $this->rmeService->generateChlink([
                'patient_id' => $patientId,
                'patient_name' => $pasien->nm_pasien,
                'practitioner_id' => $practitionerId,
                'practitioner_name' => $dokter->nm_dokter,
            ]);

            if ($chlResult['status'] === 'success') {
                return response()->json([
                    'success' => true,
                    'verification_url' => $chlResult['verification_url'],
                    'expired_at' => $chlResult['expired_at'],
                    'message' => 'Tautan verifikasi persetujuan berhasil dibuat.',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $chlResult['message'] ?? 'Gagal membuat tautan persetujuan.',
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
