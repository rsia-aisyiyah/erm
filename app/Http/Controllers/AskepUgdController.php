<?php

namespace App\Http\Controllers;

use App\Models\AskepUgd;
use App\Models\MasalahAskepUgd;
use App\Models\MasterMasalahAskepUgd;
use App\Models\MasterRencanaAskepUgd;
use App\Models\RencanaAskepUgd;
use App\Models\RsiaPenilaianGiziIgd;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AskepUgdController extends Controller
{
    protected $track;
    protected $askep;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->askep = new AskepUgd();
    }

    public function get(Request $request)
    {
        $askep = $this->askep->where('no_rawat', $request->no_rawat)
            ->with([
                'regPeriksa.pasien.bahasa',
                'regPeriksa.pasien.cacat',
                'regPeriksa.penjab',
                'regPeriksa.dokter',
                'masalahKeperawatan.masterMasalah',
                'rencanaKeperawatan.masterRencana',
                'pengkaji',
                'gizi'
            ])
            ->first();

        return response()->json($askep ?: []);
    }

    public function getMaster(Request $request)
    {
        $master = MasterMasalahAskepUgd::with('masterRencana')->orderBy('kode_masalah', 'asc')->get();
        return response()->json($master);
    }

    protected function parseDateTime(?string $dateTime): string
    {
        if (empty($dateTime) || $dateTime === '-') {
            return date('Y-m-d H:i:s');
        }
        try {
            return \Carbon\Carbon::parse($dateTime)->format('Y-m-d H:i:s');
        } catch (\Throwable $e) {
            return date('Y-m-d H:i:s');
        }
    }

    public function createOrUpdate(Request $request)
    {
        $no_rawat = $request->input('no_rawat');
        if (!$no_rawat) {
            return response()->json(['success' => false, 'message' => 'No. Rawat wajib diisi.'], 422);
        }

        $mainFields = [
            'no_rawat', 'tanggal', 'informasi', 'keluhan_utama', 'rpd', 'rpo', 'status_kehamilan',
            'gravida', 'para', 'abortus', 'hpht', 'tekanan', 'pupil', 'neurosensorik', 'integumen',
            'turgor', 'edema', 'mukosa', 'perdarahan', 'jumlah_perdarahan', 'warna_perdarahan',
            'intoksikasi', 'bab', 'xbab', 'kbab', 'wbab', 'bak', 'xbak', 'wbak', 'lbak',
            'psikologis', 'jiwa', 'perilaku', 'dilaporkan', 'sebutkan', 'hubungan', 'tinggal_dengan',
            'ket_tinggal', 'budaya', 'ket_budaya', 'pendidikan_pj', 'ket_pendidikan_pj', 'edukasi',
            'ket_edukasi', 'kemampuan', 'aktifitas', 'alat_bantu', 'ket_bantu', 'nyeri', 'provokes',
            'ket_provokes', 'quality', 'ket_quality', 'lokasi', 'menyebar', 'skala_nyeri', 'durasi',
            'nyeri_hilang', 'ket_nyeri', 'pada_dokter', 'ket_dokter', 'berjalan_a', 'berjalan_b',
            'berjalan_c', 'hasil', 'lapor', 'ket_lapor', 'nip'
        ];

        $data = $request->only($mainFields);
        $dataMasalah = $request->input('masalah', []);
        $dataRencana = $request->input('rencana_keperawatan', $request->input('rencana_intervensi', []));

        // Data Skrining Gizi
        $dataGizi = [
            'no_rawat' => $no_rawat,
            'kategori_pasien' => $request->input('gizi_kategori_pasien', 'Dewasa'),
            'sg1' => $request->input('gizi_sg1', '-'),
            'nilai1' => (int) $request->input('gizi_nilai1', 0),
            'sg2' => $request->input('gizi_sg2', '-'),
            'nilai2' => (int) $request->input('gizi_nilai2', 0),
            'sg3' => $request->input('gizi_sg3', '-'),
            'nilai3' => (int) $request->input('gizi_nilai3', 0),
            'sg4' => $request->input('gizi_sg4', '-'),
            'nilai4' => (int) $request->input('gizi_nilai4', 0),
            'total_skor' => (int) $request->input('gizi_total_skor', 0),
            'tingkat_risiko' => $request->input('gizi_tingkat_risiko', 'Risiko Rendah'),
            'lapor_gizi' => $request->input('gizi_lapor', 'Tidak'),
            'ket_lapor' => $request->input('gizi_ket_lapor', '-'),
        ];

        // Catatan teks rencana keperawatan tambahan
        $catatanRencana = $request->input('rencana');
        $data['rencana'] = is_string($catatanRencana) ? $catatanRencana : '-';

        // Sanitasi nilai default & parse format tanggal SQL YYYY-MM-DD HH:mm:ss
        $data['tanggal'] = $this->parseDateTime($data['tanggal'] ?? null);
        $nipCandidate = $data['nip'] ?? (session()->get('pegawai')->nik ?? '-');
        if (!\App\Models\Petugas::where('nip', $nipCandidate)->exists()) {
            $nipCandidate = '-';
        }
        $data['nip'] = $nipCandidate;
        $data['gravida'] = $data['gravida'] ?? '-';
        $data['para'] = $data['para'] ?? '-';
        $data['abortus'] = $data['abortus'] ?? '-';
        $data['hpht'] = $data['hpht'] ?? '-';
        $data['jumlah_perdarahan'] = $data['jumlah_perdarahan'] ?? '-';
        $data['warna_perdarahan'] = $data['warna_perdarahan'] ?? '-';
        $data['dilaporkan'] = $data['dilaporkan'] ?? '-';
        $data['sebutkan'] = $data['sebutkan'] ?? '-';
        $data['ket_tinggal'] = $data['ket_tinggal'] ?? '-';
        $data['ket_budaya'] = $data['ket_budaya'] ?? '-';
        $data['ket_pendidikan_pj'] = $data['ket_pendidikan_pj'] ?? '-';
        $data['ket_edukasi'] = $data['ket_edukasi'] ?? '-';
        $data['ket_bantu'] = $data['ket_bantu'] ?? '-';
        $data['ket_provokes'] = $data['ket_provokes'] ?? '-';
        $data['ket_quality'] = $data['ket_quality'] ?? '-';
        $data['lokasi'] = $data['lokasi'] ?? '-';
        $data['durasi'] = $data['durasi'] ?? '-';
        $data['ket_nyeri'] = $data['ket_nyeri'] ?? '-';
        $data['ket_dokter'] = $data['ket_dokter'] ?? '-';
        $data['ket_lapor'] = $data['ket_lapor'] ?? '-';
        $data['rencana'] = $data['rencana'] ?? '-';

        // Sanitasi Status Eliminasi BAB & BAK (bila dikosongkan user)
        $data['bab'] = (!empty($data['bab']) || $data['bab'] === '0') ? $data['bab'] : '-';
        $data['xbab'] = (!empty($data['xbab']) || $data['xbab'] === '0') ? $data['xbab'] : '-';
        $data['kbab'] = (!empty($data['kbab']) || $data['kbab'] === '0') ? $data['kbab'] : '-';
        $data['wbab'] = (!empty($data['wbab']) || $data['wbab'] === '0') ? $data['wbab'] : '-';
        $data['bak'] = (!empty($data['bak']) || $data['bak'] === '0') ? $data['bak'] : '-';
        $data['xbak'] = (!empty($data['xbak']) || $data['xbak'] === '0') ? $data['xbak'] : '-';
        $data['wbak'] = (!empty($data['wbak']) || $data['wbak'] === '0') ? $data['wbak'] : '-';
        $data['lbak'] = (!empty($data['lbak']) || $data['lbak'] === '0') ? $data['lbak'] : '-';

        try {
            DB::transaction(function () use ($no_rawat, $data, $dataMasalah, $dataRencana, $dataGizi) {
                $askep = $this->askep->updateOrCreate(['no_rawat' => $no_rawat], $data);

                // Simpan Skrining Gizi
                RsiaPenilaianGiziIgd::updateOrCreate(['no_rawat' => $no_rawat], $dataGizi);

                // Sinkronisasi Masalah Keperawatan
                MasalahAskepUgd::where('no_rawat', $no_rawat)->delete();
                if (!empty($dataMasalah) && is_array($dataMasalah)) {
                    foreach ($dataMasalah as $kdMasalah) {
                        if (!empty($kdMasalah)) {
                            MasalahAskepUgd::create([
                                'no_rawat' => $no_rawat,
                                'kode_masalah' => is_array($kdMasalah) ? ($kdMasalah['kode_masalah'] ?? '') : $kdMasalah,
                            ]);
                        }
                    }
                }

                // Sinkronisasi Rencana Keperawatan
                RencanaAskepUgd::where('no_rawat', $no_rawat)->delete();
                if (!empty($dataRencana) && is_array($dataRencana)) {
                    foreach ($dataRencana as $kdRencana) {
                        if (!empty($kdRencana)) {
                            RencanaAskepUgd::create([
                                'no_rawat' => $no_rawat,
                                'kode_rencana' => is_array($kdRencana) ? ($kdRencana['kode_rencana'] ?? '') : $kdRencana,
                            ]);
                        }
                    }
                }

                if ($askep->wasRecentlyCreated) {
                    $this->track->insertSql($this->askep, $data);
                } else {
                    $this->track->updateSql($this->askep, $data, ['no_rawat' => $no_rawat]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Asesmen Keperawatan UGD berhasil disimpan.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function hapus(Request $request)
    {
        $no_rawat = $request->input('no_rawat');
        if (!$no_rawat) {
            return response()->json(['success' => false, 'message' => 'No. Rawat tidak valid.'], 422);
        }

        try {
            DB::transaction(function () use ($no_rawat) {
                RsiaPenilaianGiziIgd::where('no_rawat', $no_rawat)->delete();
                MasalahAskepUgd::where('no_rawat', $no_rawat)->delete();
                RencanaAskepUgd::where('no_rawat', $no_rawat)->delete();
                $this->askep->where('no_rawat', $no_rawat)->delete();
                $this->track->deleteSql($this->askep, ['no_rawat' => $no_rawat]);
            });

            return response()->json(['success' => true, 'message' => 'Asesmen Keperawatan UGD berhasil dihapus.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data: ' . $th->getMessage()], 500);
        }
    }

    public function print(Request $request)
    {
        $askep = $this->askep->where('no_rawat', $request->no_rawat)
            ->with([
                'regPeriksa.pasien.bahasa',
                'regPeriksa.pasien.cacat',
                'regPeriksa.penjab',
                'regPeriksa.dokter',
                'masalahKeperawatan.masterMasalah',
                'rencanaKeperawatan.masterRencana',
                'pengkaji',
                'gizi'
            ])
            ->first();

        if (!$askep) {
            return abort(404, 'Data Asesmen Keperawatan UGD tidak ditemukan.');
        }

        $pdf = Pdf::loadView('content.print.askep_igd', ['data' => $askep])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Asesmen_Keperawatan_UGD_' . str_replace(['/', ' '], '_', $askep->no_rawat) . '.pdf');
    }
}
