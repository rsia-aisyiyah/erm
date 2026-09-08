<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\RegPeriksa;
use App\Models\RsiaPersetujuanAnestesi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RsiaPersetujuanAnestesiController extends Controller
{
    protected $anestesi;
    protected $track;

    public function __construct(RsiaPersetujuanAnestesi $anestesi)
    {
        $this->anestesi = $anestesi;
        $this->track = new TrackerSqlController();
    }

    public function get(Request $request): JsonResponse
    {
        $query = $this->anestesi->with(['dokterAnestesi.spesialis', 'regPeriksa.pasien', 'petugas']);

        if ($request->id) {
            $data = $query->where('id', $request->id)->first();
        } elseif ($request->no_rawat) {
            $data = $query->where('no_rawat', $request->no_rawat)
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam', 'desc')
                ->get();
        } else {
            $data = $query->orderBy('tanggal', 'desc')->limit(50)->get();
        }

        return response()->json($data);
    }

    public function getDokterAnestesi(): JsonResponse
    {
        $dokter = Dokter::with('spesialis')
            ->where('status', '1')
            ->orderBy('nm_dokter', 'asc')
            ->get();

        return response()->json($dokter);
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable',
            'no_rawat' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'kd_dokter_anestesi' => 'required',
            'pemberi_informasi' => 'required',
            'penerima_informasi' => 'required',
            'diagnosis' => 'nullable',
            'dasar_diagnosis' => 'nullable',
            'tindakan_medis' => 'nullable',
            'indikasi_tindakan' => 'nullable',
            'tata_cara' => 'nullable',
            'tujuan' => 'nullable',
            'risiko' => 'nullable',
            'komplikasi' => 'nullable',
            'prognosis' => 'nullable',
            'alternatif_dan_risiko' => 'nullable',
            'check_diagnosis' => 'nullable',
            'check_dasar_diagnosis' => 'nullable',
            'check_tindakan_medis' => 'nullable',
            'check_indikasi_tindakan' => 'nullable',
            'check_tata_cara' => 'nullable',
            'check_tujuan' => 'nullable',
            'check_risiko' => 'nullable',
            'check_komplikasi' => 'nullable',
            'check_prognosis' => 'nullable',
            'check_alternatif' => 'nullable',
            'jenis_pernyataan' => 'required',
            'hubungan' => 'required',
            'nama_pj' => 'required',
            'tgl_lahir_pj' => 'nullable',
            'umur_pj' => 'nullable',
            'jk_pj' => 'nullable',
            'alamat_pj' => 'nullable',
            'no_telp_pj' => 'nullable',
            'saksi_keluarga' => 'nullable',
            'saksi_tenaga_medis' => 'nullable',
            'nip_petugas' => 'nullable',
            'tanda_tangan_pj' => 'nullable',
            'tanda_tangan_saksi_keluarga' => 'nullable',
        ]);

        $validated['nip_petugas'] = $request->nip_petugas ?: (session()->get('pegawai')->nik ?? null);

        // Simpan / update file tanda tangan pasien jika ada data base64 baru
        if ($request->filled('tanda_tangan_pj')) {
            $validated['tanda_tangan_pj'] = $this->handleSignature($validated['no_rawat'], $request->tanda_tangan_pj);
        }
        // Simpan / update file tanda tangan saksi keluarga jika ada data base64 baru
        if ($request->filled('tanda_tangan_saksi_keluarga')) {
            $validated['tanda_tangan_saksi_keluarga'] = $this->handleSignature($validated['no_rawat'], $request->tanda_tangan_saksi_keluarga);
        }

        // Set default checkbox values ('1' jika dicentang, '0' jika tidak)
        $checkboxFields = [
            'check_diagnosis', 'check_dasar_diagnosis', 'check_tindakan_medis',
            'check_indikasi_tindakan', 'check_tata_cara', 'check_tujuan',
            'check_risiko', 'check_komplikasi', 'check_prognosis', 'check_alternatif'
        ];
        foreach ($checkboxFields as $cb) {
            $validated[$cb] = !empty($validated[$cb]) ? '1' : '0';
        }

        try {
           if (!empty($validated['id'])) {

    $id = $validated['id'];
    unset($validated['id']);

    // Ambil instance model agar event Eloquent "updated" terpanggil
    $record = $this->anestesi->findOrFail($id);

    // Update melalui instance
    $record->fill($validated);
    $record->save();

    try {
        $this->track->updateSql(
            $this->anestesi,
            $validated,
            ['id' => $id]
        );
    } catch (\Throwable $t) {
        // Jangan menggagalkan proses utama jika audit legacy gagal
    }

    $pesan = 'Berhasil memperbarui data persetujuan regional anestesi.';

} else {

    unset($validated['id']);

    // create() akan memicu event "created"
    $record = $this->anestesi->create($validated);

    try {
        $this->track->insertSql(
            $this->anestesi,
            $validated
        );
    } catch (\Throwable $t) {
        // Jangan menggagalkan proses utama jika audit legacy gagal
    }

    $pesan = 'Berhasil menyimpan data persetujuan regional anestesi baru.';
}

            return response()->json([
                'status' => true,
                'message' => $pesan,
                'data' => $record
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan database: ' . $e->getMessage(),
                'error' => $e->errorInfo
            ], 500);
        }
    }

    public function hapus(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $record = $this->anestesi->find($request->id);
            if (!$record) {
                return response()->json(['status' => false, 'message' => 'Data tidak ditemukan.'], 404);
            }

            $record->delete();
            try {
                $this->track->deleteSql($this->anestesi, ['id' => $request->id]);
            } catch (\Throwable $t) {}

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data persetujuan regional anestesi.'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function print(Request $request)
    {
        $query = $this->anestesi->with(['dokterAnestesi.spesialis', 'petugas']);

        if ($request->id) {
            $anestesi = $query->where('id', $request->id)->first();
        } elseif ($request->no_rawat) {
            $cleanNoRawat = str_replace('-', '/', $request->no_rawat);
            $anestesi = $query->where('no_rawat', $cleanNoRawat)
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam', 'desc')
                ->first();
        } else {
            return response()->json(['message' => 'Parameter ID atau No Rawat tidak valid'], 400);
        }

        if (!$anestesi) {
            return response()->json(['message' => 'Data persetujuan regional anestesi tidak ditemukan'], 404);
        }

        $regPeriksa = RegPeriksa::with([
            'pasien.kel',
            'pasien.kec',
            'pasien.kab',
            'kamarInap.kamar.bangsal',
            'dokter',
            'poliklinik'
        ])->where('no_rawat', $anestesi->no_rawat)->first();

        if (!$regPeriksa) {
            return response()->json(['message' => 'Data registrasi pasien tidak ditemukan'], 404);
        }

        $pdf = Pdf::loadView('content.print.persetujuan_regional_anestesi', [
            'regPeriksa' => $regPeriksa,
            'anestesi' => $anestesi,
        ])->setPaper('A4', 'portrait');

        $cleanFileNoRawat = str_replace('/', '_', $anestesi->no_rawat);
        return $pdf->stream('Informed_Consent_RA_' . $cleanFileNoRawat . '_ID' . $anestesi->id . '.pdf');
    }

    protected function handleSignature(string $noRawat, ?string $signatureData): ?string
    {
        if (empty($signatureData)) {
            return null;
        }

        // Jika bukan base64 baru (misal path file lama yang tidak diubah), pertahankan
        if (!str_starts_with($signatureData, 'data:image')) {
            return $signatureData;
        }

        @list($type, $data) = explode(';', $signatureData);
        @list(, $data) = explode(',', $data);

        if (empty($data)) {
            return null;
        }

        $binary = base64_decode($data);
        if ($binary === false) {
            return null;
        }

        $folder = 'signatures/anestesi';

        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($folder)) {
            \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory($folder);
        }

        $fileName = 'ttd_ra_'. \Illuminate\Support\Str::uuid()->toString() . '.png';
        $filePath = $folder . '/' . $fileName;

        \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, $binary);

        return $filePath;
    }
}
