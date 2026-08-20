<?php

namespace App\Http\Controllers;

use App\Models\DetailBeriDiet;
use App\Models\Diet;
use App\Models\KamarInap;
use App\Models\RsiaPermintaanDiet;
use App\Models\RsiaSkriningGizi;
use App\Models\SkriningGizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermintaanDietController extends Controller
{
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }

    private function checkSkriningGizi($no_rawat)
    {
        $rsiaSkrining = RsiaSkriningGizi::where('no_rawat', $no_rawat)->first();
        if ($rsiaSkrining) {
            return [
                'has_skrining' => true,
                'sumber' => 'rsia_skrining_gizi',
                'info' => [
                    'bb' => $rsiaSkrining->bb ?? '-',
                    'tb' => $rsiaSkrining->tb ?? '-',
                    'imt' => $rsiaSkrining->imt ?? '-',
                    'skor' => $rsiaSkrining->skor ?? '-',
                    'keterangan' => $rsiaSkrining->keterangan ?? '-',
                    'jenis_diet' => $rsiaSkrining->jenis_diet ?? '',
                ]
            ];
        }

        $skriningKz = SkriningGizi::where('no_rawat', $no_rawat)->first();
        if ($skriningKz) {
            return [
                'has_skrining' => true,
                'sumber' => 'skrining_gizi',
                'info' => [
                    'bb' => $skriningKz->skrining_bb ?? '-',
                    'tb' => $skriningKz->skrining_tb ?? '-',
                    'imt' => $skriningKz->parameter_imt ?? '-',
                    'skor' => $skriningKz->skor_total ?? '-',
                    'keterangan' => $skriningKz->parameter_total ?? '-',
                ]
            ];
        }

        $asuhanGizi = DB::table('asuhan_gizi')->where('no_rawat', $no_rawat)->first();
        if ($asuhanGizi) {
            return [
                'has_skrining' => true,
                'sumber' => 'asuhan_gizi',
                'info' => [
                    'bb' => $asuhanGizi->antropometri_bb ?? '-',
                    'tb' => $asuhanGizi->antropometri_tb ?? '-',
                    'imt' => $asuhanGizi->antropometri_imt ?? '-',
                    'skor' => '-',
                    'keterangan' => $asuhanGizi->diagnosis ?? '-',
                ]
            ];
        }

        $askepAnak = DB::table('penilaian_awal_keperawatan_ranap_anak')->where('no_rawat', $no_rawat)->first();
        if ($askepAnak) {
            return [
                'has_skrining' => true,
                'sumber' => 'askep_ranap_anak',
                'info' => [
                    'bb' => $askepAnak->pemeriksaan_bb ?? '-',
                    'tb' => $askepAnak->pemeriksaan_tb ?? '-',
                    'imt' => '-',
                    'skor' => $askepAnak->nilai_total_gizi ?? 0,
                    'keterangan' => ($askepAnak->nilai_total_gizi >= 4 ? 'Resiko Tinggi' : ($askepAnak->nilai_total_gizi >= 2 ? 'Resiko Sedang' : 'Resiko Rendah')),
                ]
            ];
        }

        $askepKebidanan = DB::table('penilaian_awal_keperawatan_kebidanan_ranap')->where('no_rawat', $no_rawat)->first();
        if ($askepKebidanan) {
            return [
                'has_skrining' => true,
                'sumber' => 'askep_ranap_kebidanan',
                'info' => [
                    'bb' => $askepKebidanan->bb ?? '-',
                    'tb' => $askepKebidanan->tb ?? '-',
                    'imt' => '-',
                    'skor' => $askepKebidanan->total_nilai_skrining_gizi ?? 0,
                    'keterangan' => 'Asesmen Kebidanan',
                ]
            ];
        }

        $askepNeonatus = DB::table('penilaian_awal_keperawatan_ranap_neonatus')->where('no_rawat', $no_rawat)->first();
        if ($askepNeonatus) {
            return [
                'has_skrining' => true,
                'sumber' => 'askep_ranap_neonatus',
                'info' => [
                    'bb' => $askepNeonatus->pemeriksaan_bb ?? '-',
                    'tb' => $askepNeonatus->pemeriksaan_tb ?? '-',
                    'imt' => '-',
                    'skor' => $askepNeonatus->nilai_total_gizi ?? 0,
                    'keterangan' => 'Asesmen Neonatus',
                ]
            ];
        }

        $askepRanap = DB::table('penilaian_awal_keperawatan_ranap')->where('no_rawat', $no_rawat)->first();
        if ($askepRanap) {
            return [
                'has_skrining' => true,
                'sumber' => 'askep_ranap',
                'info' => [
                    'bb' => $askepRanap->bb ?? '-',
                    'tb' => $askepRanap->tb ?? '-',
                    'imt' => '-',
                    'skor' => $askepRanap->total_skor ?? '-',
                    'keterangan' => 'Asesmen Keperawatan Ranap',
                ]
            ];
        }

        return [
            'has_skrining' => false,
            'sumber' => null,
            'info' => null,
        ];
    }

    public function getMasterDiet()
    {
        $diet = Diet::orderBy('nama_diet', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $diet
        ]);
    }

    public function get(Request $request)
    {
        $no_rawat = $request->input('no_rawat');
        $tanggal = $request->input('tanggal', date('Y-m-d'));

        if (!$no_rawat) {
            return response()->json(['success' => false, 'message' => 'No. Rawat wajib diisi.'], 422);
        }

        $permintaan = RsiaPermintaanDiet::where('no_rawat', $no_rawat)
            ->where('tanggal', $tanggal)
            ->first();

        $detailDiet = DetailBeriDiet::where('no_rawat', $no_rawat)
            ->where('tanggal', $tanggal)
            ->with('diet')
            ->get();

        $kdDiet = $detailDiet->first()?->kd_diet ?? '';
        $skriningStatus = $this->checkSkriningGizi($no_rawat);

        return response()->json([
            'success' => true,
            'data' => [
                'permintaan' => $permintaan,
                'detail_diet' => $detailDiet,
                'kd_diet' => $kdDiet,
                'skrining_gizi' => $skriningStatus,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
        ]);

        $no_rawat = $request->input('no_rawat');

        $skriningStatus = $this->checkSkriningGizi($no_rawat);
        if (!$skriningStatus['has_skrining']) {
            return response()->json([
                'success' => false,
                'code' => 'SKRINING_GIZI_REQUIRED',
                'message' => 'Pasien belum memiliki data Skrining Gizi. Silakan lengkapi Skrining Gizi terlebih dahulu.',
            ], 422);
        }
        $tanggal = $request->input('tanggal');
        $kd_diet = $request->input('kd_diet', '');
        $pagi = $request->input('pagi', '-');
        $siang = $request->input('siang', '-');
        $sore = $request->input('sore', '-');
        $permintaan_khusus = $request->input('permintaan_khusus', '');

        // Cari kamar inap aktif pasien
        $kamarInap = KamarInap::where('no_rawat', $no_rawat)
            ->where('stts_pulang', '-')
            ->first();

        $kd_kamar = $request->input('kd_kamar') ?: ($kamarInap->kd_kamar ?? '-');

        try {
            DB::transaction(function () use ($no_rawat, $tanggal, $kd_kamar, $kd_diet, $pagi, $siang, $sore, $permintaan_khusus) {
                // 1. Simpan ke rsia_permintaan_diet
                $dataPermintaan = [
                    'no_rawat' => $no_rawat,
                    'tanggal' => $tanggal,
                    'pagi' => $pagi,
                    'siang' => $siang,
                    'sore' => $sore,
                    'permintaan_khusus' => $permintaan_khusus ?? '',
                ];

                RsiaPermintaanDiet::updateOrCreate(
                    ['no_rawat' => $no_rawat, 'tanggal' => $tanggal],
                    $dataPermintaan
                );

                // 2. Sinkronkan ke detail_beri_diet untuk jam makan (Pagi, Siang, Sore)
                $waktuMap = [
                    'Pagi' => $pagi,
                    'Siang' => $siang,
                    'Sore' => $sore,
                ];

                foreach ($waktuMap as $waktu => $status) {
                    if ($status === 'Ya' && !empty($kd_diet)) {
                        DetailBeriDiet::updateOrCreate(
                            [
                                'no_rawat' => $no_rawat,
                                'tanggal' => $tanggal,
                                'waktu' => $waktu,
                            ],
                            [
                                'kd_kamar' => $kd_kamar,
                                'kd_diet' => $kd_diet,
                            ]
                        );
                    } else {
                        DetailBeriDiet::where('no_rawat', $no_rawat)
                            ->where('tanggal', $tanggal)
                            ->where('waktu', $waktu)
                            ->delete();
                    }
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Permintaan diet pasien berhasil disimpan.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan permintaan diet: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $no_rawat = $request->input('no_rawat');
        $tanggal = $request->input('tanggal');

        if (!$no_rawat || !$tanggal) {
            return response()->json(['success' => false, 'message' => 'Parameter tidak lengkap.'], 422);
        }

        try {
            DB::transaction(function () use ($no_rawat, $tanggal) {
                RsiaPermintaanDiet::where('no_rawat', $no_rawat)->where('tanggal', $tanggal)->delete();
                DetailBeriDiet::where('no_rawat', $no_rawat)->where('tanggal', $tanggal)->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'Permintaan diet berhasil dihapus.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus permintaan diet: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function riwayat(Request $request)
    {
        $no_rawat = $request->input('no_rawat');

        if (!$no_rawat) {
            return response()->json(['success' => false, 'message' => 'No. Rawat wajib diisi.'], 422);
        }

        $listPermintaan = RsiaPermintaanDiet::where('no_rawat', $no_rawat)
            ->orderBy('tanggal', 'desc')
            ->get();

        $listDetail = DetailBeriDiet::where('no_rawat', $no_rawat)
            ->with('diet')
            ->get()
            ->groupBy('tanggal');

        $result = $listPermintaan->map(function ($item) use ($listDetail) {
            $details = $listDetail->get($item->tanggal);
            $namaDiet = $details ? $details->first()?->diet?->nama_diet ?? '-' : '-';

            return [
                'tanggal' => $item->tanggal,
                'pagi' => $item->pagi,
                'siang' => $item->siang,
                'sore' => $item->sore,
                'permintaan_khusus' => $item->permintaan_khusus,
                'nama_diet' => $namaDiet,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
