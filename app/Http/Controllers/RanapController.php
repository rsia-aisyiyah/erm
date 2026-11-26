<?php

namespace App\Http\Controllers;

use App\Models\KamarInap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RanapController extends Controller
{
    public $tanggal;

    public function __construct()
    {
        $this->tanggal = new Carbon();
    }

    public function index()
    {
        return view('content.ranap.ranap');
    }

    public function ranap(Request $request)
    {

        $ranap = KamarInap::with([
            'regPeriksa.poc',
            'edukasiObatPulang',
            'pasien',
            'regPeriksa' => function ($q) {
                $q->select(
                    DB::raw('TRIM(kd_dokter) as kd_dokter'),
                    DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
                    DB::raw('TRIM(kd_poli) as kd_poli'),
                    DB::raw('TRIM(kd_pj) as kd_pj'),
                    'no_rawat',
                    'umurdaftar',
                    'sttsumur',
                    'no_reg',
                    'tgl_registrasi',
                    'jam_reg'
                )->with([
                            'pasien',
                            'dokter' => function ($q) {
                                $q->with(['spesialis', 'mappingDokter']);
                            },
                            'penjab',
                            'kamarInap',
                        ]);
            },
            'asmedKandungan',
            'asmedAnak',
            'askepNeonatus',
            'askepAnak',
            'askepKandungan',
            'asmedUmum',
            'kamar',
            'dischargePlanning',
            'ranapGabung.regPeriksa.dokter',
            'ranapGabung.regPeriksa.pasien',
            'ranapGabung.regPeriksa.askepRanapNeonatus',
            'ranapGabung.regPeriksa.asmedRanapAnak',
            'kamar.bangsal',
            'resume',
            'skoringTb',
            'skriningTb',
            'rsiaSkriningGizi',
            'skriningGizi'
        ])->orderBy('no_rawat', 'DESC');

        if ($request->stts_pulang == '-') {
            $ranap->where('stts_pulang', $request->stts_pulang);
        } else if ($request->stts_pulang == 'Masuk') {
            $ranap->whereBetween('tgl_masuk', [$request->tgl_pertama, $request->tgl_kedua])
                ->where('stts_pulang', '!=', 'Pindah Kamar');
        } else if ($request->stts_pulang == 'Pulang') {
            $ranap->whereBetween('tgl_keluar', [$request->tgl_pertama, $request->tgl_kedua])
                ->whereNotIn('stts_pulang', ['-', 'Pindah Kamar']);
        } else if ($request->stts_pulang == 'Rujuk') {
            $ranap->whereBetween('tgl_keluar', [$request->tgl_pertama, $request->tgl_kedua])
                ->where('stts_pulang', 'like', '%Rujuk%');
        }

        if ($request->kd_dokter) {
            $ranap->whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('kd_dokter', $request->kd_dokter);
            });
        }

        if ($request->spesialis) {
            $ranap->whereHas('regPeriksa.dokter', function ($q) use ($request) {
                $q->where('kd_sps', $request->spesialis);
            });
        }

        if ($request->kamar) {
            $ranap->whereHas('kamar.bangsal', function ($q) use ($request) {
                $q->where('nm_bangsal', 'like', '%' . $request->kamar . '%');
            });
        }

        return DataTables::of($ranap)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('regPeriksa.pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })
            ->addColumn('lama', function ($ranap) {
                $date1 = $ranap->regPeriksa->tgl_registrasi; // Adjust this to your date columns
                $date2 = $ranap->tgl_keluar === '0000-00-00' ? date('Y-m-d') : $ranap->tgl_keluar; // Adjust this to your date columns
                return Carbon::parse($date1)->diffInDays($date2) + 1;
                // return $date1->diffInDays($date2);
            })
            ->make(true);
    }

    /**
     * Monitoring pasien Ranap berstatus Pulang:
     * 1. Tanggal kontrol di resume_pasien_ranap tidak cocok dengan tgl_rencana di bridging_surat_kontrol_bpjs
     * 2. Belum terbit resume medis (resume_pasien_ranap)
     * 3. Pasien BPJS belum membuat surat kontrol (bridging_surat_kontrol_bpjs via bridging_sep.no_sep)
     */
    public function monitoringPulang(Request $request)
    {
        $tglAkhir = $request->filled('tgl_kedua')
            ? $request->tgl_kedua
            : Carbon::today()->format('Y-m-d');

        $days = (int) $request->input('days', 3);
        if ($days < 1 || $days > 31) {
            $days = 3;
        }

        $tglAwal = $request->filled('tgl_pertama')
            ? $request->tgl_pertama
            : Carbon::parse($tglAkhir)->subDays($days - 1)->format('Y-m-d');

        $query = DB::table('kamar_inap as ki')
            ->join('reg_periksa as rp', 'rp.no_rawat', '=', 'ki.no_rawat')
            ->join('pasien as p', 'p.no_rkm_medis', '=', 'rp.no_rkm_medis')
            ->join('penjab as pj', 'pj.kd_pj', '=', 'rp.kd_pj')
            ->leftJoin('dokter as d', 'd.kd_dokter', '=', 'rp.kd_dokter')
            ->leftJoin('kamar as k', 'k.kd_kamar', '=', 'ki.kd_kamar')
            ->leftJoin('bangsal as b', 'b.kd_bangsal', '=', 'k.kd_bangsal')
            ->leftJoin('resume_pasien_ranap as rpr', 'rpr.no_rawat', '=', 'ki.no_rawat')
            ->whereNotIn('ki.stts_pulang', ['-', 'Pindah Kamar'])
            ->whereNotNull('ki.tgl_keluar')
            ->where('ki.tgl_keluar', '!=', '0000-00-00')
            ->whereBetween('ki.tgl_keluar', [$tglAwal, $tglAkhir])
            ->select([
                'ki.no_rawat',
                'ki.tgl_masuk',
                'ki.tgl_keluar',
                'ki.jam_keluar',
                'ki.stts_pulang',
                'rp.no_rkm_medis',
                'rp.kd_dokter',
                'rp.kd_pj',
                'p.nm_pasien',
                'p.no_peserta',
                'pj.png_jawab',
                'd.nm_dokter',
                'd.kd_sps',
                'b.nm_bangsal',
                'rpr.no_rawat as resume_no_rawat',
                'rpr.kontrol as resume_kontrol',
                'rpr.keadaan as resume_keadaan',
                'rpr.cara_keluar as resume_cara_keluar',
                'rpr.dilanjutkan as resume_dilanjutkan',
            ])
            ->orderByDesc('ki.tgl_keluar')
            ->orderByDesc('ki.jam_keluar');

        if ($request->filled('kd_dokter')) {
            $query->where('rp.kd_dokter', $request->kd_dokter);
        }

        if ($request->filled('spesialis')) {
            $query->where('d.kd_sps', $request->spesialis);
        }

        if ($request->filled('kamar')) {
            $query->where('b.nm_bangsal', 'like', '%' . $request->kamar . '%');
        }

        $rows = $query->get()->unique('no_rawat')->values();

        if ($rows->isEmpty()) {
            return response()->json([
                'success' => true,
                'periode' => ['awal' => $tglAwal, 'akhir' => $tglAkhir],
                'summary' => [
                    'total_pulang' => 0,
                    'total_bermasalah' => 0,
                    'tanggal_tidak_cocok' => 0,
                    'belum_resume' => 0,
                    'belum_surat_kontrol' => 0,
                ],
                'items' => [],
            ]);
        }

        $noRawats = $rows->pluck('no_rawat')->all();

        // Ambil SEP per no_rawat (prioritaskan jnspelayanan = '1' / Rawat Inap)
        $sepByNoRawat = DB::table('bridging_sep')
            ->whereIn('no_rawat', $noRawats)
            ->select(['no_rawat', 'no_sep', 'jnspelayanan', 'tglsep'])
            ->orderByRaw("CASE WHEN jnspelayanan = '1' THEN 0 ELSE 1 END ASC")
            ->orderByDesc('tglsep')
            ->get()
            ->groupBy('no_rawat')
            ->map(function ($group) {
                return $group->first();
            });

        $noSeps = $sepByNoRawat->pluck('no_sep')->filter()->unique()->values()->all();

        // Ambil Surat Kontrol BPJS per no_sep (terbaru)
        $suratKontrolBySep = collect();
        if (!empty($noSeps)) {
            $suratKontrolBySep = DB::table('bridging_surat_kontrol_bpjs')
                ->whereIn('no_sep', $noSeps)
                ->select(['no_sep', 'no_surat', 'tgl_surat', 'tgl_rencana', 'nm_poli_bpjs', 'nm_dokter_bpjs'])
                ->orderByDesc('tgl_surat')
                ->orderByDesc('tgl_rencana')
                ->get()
                ->groupBy('no_sep')
                ->map(function ($group) {
                    return $group->first();
                });
        }

        $normalizeDate = function ($val): ?string {
            if (empty($val)) {
                return null;
            }
            $str = trim((string) $val);
            if ($str === '-' || str_starts_with($str, '0000-00-00')) {
                return null;
            }
            $datePart = substr($str, 0, 10);
            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $datePart) ? $datePart : null;
        };

        $items = [];
        $countMismatch = 0;
        $countBelumResume = 0;
        $countBelumSk = 0;

        foreach ($rows as $row) {
            $sep = $sepByNoRawat->get($row->no_rawat);
            $noSep = $sep->no_sep ?? null;
            $sk = $noSep ? $suratKontrolBySep->get($noSep) : null;

            $isBpjs = stripos((string) $row->png_jawab, 'BPJS') !== false || !empty($noSep);
            $hasResume = !empty($row->resume_no_rawat);
            $tglKontrolResume = $hasResume ? $normalizeDate($row->resume_kontrol) : null;
            $tglKontrolBpjs = $sk ? $normalizeDate($sk->tgl_rencana) : null;

            $isMeninggal = stripos((string) $row->stts_pulang, 'meninggal') !== false
                || ($row->resume_keadaan ?? '') === 'Meninggal';
            $isTidakPerluKontrolRs = $isMeninggal
                || in_array($row->resume_cara_keluar ?? '', ['Pindah RS', 'Pulang Atas Permintaan Sendiri'], true)
                || in_array($row->resume_dilanjutkan ?? '', ['RS Lain', 'Puskesmes'], true);

            $issues = [];

            // 1. Belum terbit resume medis
            if (!$hasResume) {
                $issues[] = 'belum_resume';
                $countBelumResume++;
            }

            // 2. Cek khusus pasien BPJS Kesehatan (Surat Kontrol via SEP)
            if ($isBpjs && !$isTidakPerluKontrolRs) {
                if (empty($sk) || empty($sk->no_surat)) {
                    $issues[] = 'belum_surat_kontrol';
                    $countBelumSk++;
                } elseif ($hasResume && !empty($tglKontrolResume) && !empty($tglKontrolBpjs) && $tglKontrolResume !== $tglKontrolBpjs) {
                    $issues[] = 'tanggal_tidak_cocok';
                    $countMismatch++;
                } elseif ($hasResume && empty($tglKontrolResume) && !empty($tglKontrolBpjs)) {
                    // Surat kontrol BPJS sudah terbit, tapi tanggal kontrol di resume medis masih kosong
                    $issues[] = 'tanggal_tidak_cocok';
                    $countMismatch++;
                }
            }

            if (!empty($issues)) {
                $items[] = [
                    'no_rawat' => $row->no_rawat,
                    'no_rkm_medis' => $row->no_rkm_medis,
                    'nm_pasien' => $row->nm_pasien,
                    'nm_bangsal' => $row->nm_bangsal ?? '-',
                    'nm_dokter' => $row->nm_dokter ?? '-',
                    'png_jawab' => $row->png_jawab ?? '-',
                    'is_bpjs' => $isBpjs,
                    'tgl_keluar' => $row->tgl_keluar,
                    'jam_keluar' => $row->jam_keluar,
                    'stts_pulang' => $row->stts_pulang,
                    'has_resume' => $hasResume,
                    'tgl_kontrol_resume' => $tglKontrolResume,
                    'no_sep' => $noSep,
                    'no_surat_kontrol' => $sk->no_surat ?? null,
                    'tgl_kontrol_bpjs' => $tglKontrolBpjs,
                    'nm_poli_bpjs' => $sk->nm_poli_bpjs ?? null,
                    'issues' => $issues,
                ];
            }
        }

        // Urutkan prioritas: tanggal tidak cocok paling atas, lalu belum surat kontrol, lalu belum resume
        usort($items, function ($a, $b) {
            $score = function ($item) {
                $s = 0;
                if (in_array('tanggal_tidak_cocok', $item['issues'], true))
                    $s += 4;
                if (in_array('belum_surat_kontrol', $item['issues'], true))
                    $s += 2;
                if (in_array('belum_resume', $item['issues'], true))
                    $s += 1;
                return $s;
            };
            $diff = $score($b) <=> $score($a);
            if ($diff !== 0) {
                return $diff;
            }
            return strcmp((string) $b['tgl_keluar'], (string) $a['tgl_keluar']);
        });

        return response()->json([
            'success' => true,
            'periode' => ['awal' => $tglAwal, 'akhir' => $tglAkhir],
            'summary' => [
                'total_pulang' => $rows->count(),
                'total_bermasalah' => count($items),
                'tanggal_tidak_cocok' => $countMismatch,
                'belum_resume' => $countBelumResume,
                'belum_surat_kontrol' => $countBelumSk,
            ],
            'items' => $items,
        ]);
    }

    /**
     * Cek kelengkapan berkas utama Rawat Inap per no_rawat:
     * - Askep Awal (Anak / Neonatus untuk pasien anak, Kebidanan untuk pasien ibu/obgyn)
     * - Asesmen Awal Medis IGD, Asesmen Medis Obgyn, Asesmen Medis Anak
     * - Resume Medis Ranap
     * - Pemeriksaan Penunjang Lab & Radiologi
     * - Plan of Care (POC)
     * - Asesmen Nyeri (sesuai kelompok usia)
     * - Skoring & Skrining TB
     * - Discharge Planning
     */
    public function kelengkapanBerkas(Request $request)
    {
        $noRawat = trim((string) $request->input('no_rawat', ''));
        if ($noRawat === '') {
            return response()->json([
                'success' => false,
                'message' => 'Parameter no_rawat wajib diisi.',
            ], 422);
        }

        $reg = DB::table('reg_periksa as rp')
            ->join('pasien as p', 'p.no_rkm_medis', '=', 'rp.no_rkm_medis')
            ->leftJoin('dokter as d', 'd.kd_dokter', '=', 'rp.kd_dokter')
            ->leftJoin('spesialis as s', 's.kd_sps', '=', 'd.kd_sps')
            ->leftJoin('penjab as pj', 'pj.kd_pj', '=', 'rp.kd_pj')
            ->where('rp.no_rawat', $noRawat)
            ->select([
                'rp.no_rawat',
                'rp.no_rkm_medis',
                'rp.tgl_registrasi',
                'rp.umurdaftar',
                'rp.sttsumur',
                'rp.kd_dokter',
                'rp.kd_pj',
                'p.nm_pasien',
                'p.tgl_lahir',
                'p.jk',
                'd.nm_dokter',
                'd.kd_sps',
                's.nm_sps',
                'pj.png_jawab',
            ])
            ->first();

        if (!$reg) {
            return response()->json([
                'success' => false,
                'message' => 'Data registrasi pasien tidak ditemukan.',
            ], 404);
        }

        $kdSps = trim((string) ($reg->kd_sps ?? ''));
        $isAnak = $kdSps === 'S0003';
        $isObgyn = $kdSps === 'S0001';

        $totalHari = 99999;
        if (!empty($reg->tgl_lahir) && !empty($reg->tgl_registrasi)) {
            try {
                $totalHari = Carbon::parse($reg->tgl_lahir)->diffInDays(Carbon::parse($reg->tgl_registrasi));
            } catch (\Throwable $e) {
                $totalHari = 99999;
            }
        }
        $isNeonatus = $isAnak && ($reg->sttsumur === 'Hr' || $totalHari <= 28);

        $safeFirst = function (string $table) use ($noRawat) {
            try {
                return DB::table($table)->where('no_rawat', $noRawat)->first();
            } catch (\Throwable $e) {
                return null;
            }
        };

        $safeCount = function (string $table) use ($noRawat): int {
            try {
                return (int) DB::table($table)->where('no_rawat', $noRawat)->count();
            } catch (\Throwable $e) {
                return 0;
            }
        };

        $extractDate = function ($row): ?string {
            if (!$row) {
                return null;
            }
            foreach (['tanggal', 'tgl_perawatan', 'tgl_periksa', 'tgl_permintaan', 'tgl_masuk', 'created_at'] as $col) {
                if (isset($row->{$col}) && !empty($row->{$col}) && !str_starts_with((string) $row->{$col}, '0000-00-00')) {
                    return (string) $row->{$col};
                }
            }
            return null;
        };

        // 1. Asesmen Awal Keperawatan / Kebidanan
        $askepAnak = $safeFirst('penilaian_awal_keperawatan_ranap_anak');
        $askepNeonatus = $safeFirst('penilaian_awal_keperawatan_ranap_neonatus');
        $askepKebidanan = $safeFirst('penilaian_awal_keperawatan_kebidanan_ranap');

        // 2. Asesmen Awal Medis (IGD, Obgyn, Anak)
        $asmedIgd = $safeFirst('penilaian_medis_igd');
        $asmedObgyn = $safeFirst('penilaian_medis_ranap_kandungan');
        $asmedAnak = $safeFirst('penilaian_medis_ranap');

        // 3. Resume Medis
        $resume = $safeFirst('resume_pasien_ranap');

        // 4. Penunjang Lab & Radiologi
        $countPermintaanLab = $safeCount('permintaan_lab');
        $countHasilLab = $safeCount('periksa_lab');
        $countPermintaanRad = $safeCount('permintaan_radiologi');
        $countHasilRad = $safeCount('hasil_radiologi');
        $countPeriksaRad = $safeCount('periksa_radiologi');

        // 5. Plan of Care
        $poc = $safeFirst('plan_of_care');

        // 6. Asesmen Nyeri (sesuai kategori usia & cek semua tabel agar tidak false-negative)
        $nyeriTables = [
            'neonatus' => ['table' => 'rsia_asesmen_nyeri_neonatal', 'label' => 'Asesmen Nyeri Neonatus', 'action' => 'nyeri_neonatus'],
            'batita' => ['table' => 'rsia_asesmen_nyeri_anak_1bl3th', 'label' => 'Asesmen Nyeri Batita (FLACC)', 'action' => 'nyeri_batita'],
            'balita' => ['table' => 'rsia_asesmen_nyeri_anak_3th7th', 'label' => 'Asesmen Nyeri Balita', 'action' => 'nyeri_balita'],
            'anak' => ['table' => 'rsia_asesmen_nyeri_anak_7th', 'label' => 'Asesmen Nyeri Anak (7-13 Th)', 'action' => 'nyeri_anak'],
            'dewasa' => ['table' => 'rsia_asesmen_nyeri_dewasa', 'label' => 'Asesmen Nyeri Dewasa', 'action' => 'nyeri_dewasa'],
        ];

        if ($totalHari <= 28) {
            $nyeriKey = 'neonatus';
        } elseif ($totalHari <= 3 * 365) {
            $nyeriKey = 'batita';
        } elseif ($totalHari <= 7 * 365) {
            $nyeriKey = 'balita';
        } elseif ($totalHari <= 13 * 365) {
            $nyeriKey = 'anak';
        } else {
            $nyeriKey = 'dewasa';
        }

        $nyeriRow = $safeFirst($nyeriTables[$nyeriKey]['table']);
        $nyeriSourceLabel = $nyeriTables[$nyeriKey]['label'];
        if (!$nyeriRow) {
            foreach ($nyeriTables as $k => $cfg) {
                if ($k === $nyeriKey) {
                    continue;
                }
                $alt = $safeFirst($cfg['table']);
                if ($alt) {
                    $nyeriRow = $alt;
                    $nyeriSourceLabel = $cfg['label'];
                    break;
                }
            }
        }

        // 7. Skoring & Skrining TB
        $skoringTb = $safeFirst('rsia_skoring_tb');
        $skriningTb = $safeFirst('rsia_skrining_tb');

        // 8. Discharge Planning
        $discharge = $safeFirst('rsia_discharge_planning');

        // 9. Surat Kontrol BPJS (ambil no_sep berdasarkan no_rawat lalu cocokkan ke bridging_surat_kontrol_bpjs)
        $sep = null;
        try {
            $sep = DB::table('bridging_sep')
                ->where('no_rawat', $noRawat)
                ->select(['no_rawat', 'no_sep', 'jnspelayanan', 'tglsep'])
                ->orderByRaw("CASE WHEN jnspelayanan = '1' THEN 0 ELSE 1 END ASC")
                ->orderByDesc('tglsep')
                ->first();
        } catch (\Throwable $e) {
            $sep = null;
        }

        $noSep = $sep->no_sep ?? null;
        $suratKontrol = null;
        if (!empty($noSep)) {
            try {
                $suratKontrol = DB::table('bridging_surat_kontrol_bpjs')
                    ->where('no_sep', $noSep)
                    ->select(['no_sep', 'no_surat', 'tgl_surat', 'tgl_rencana', 'nm_poli_bpjs', 'nm_dokter_bpjs'])
                    ->orderByDesc('tgl_surat')
                    ->orderByDesc('tgl_rencana')
                    ->first();
            } catch (\Throwable $e) {
                $suratKontrol = null;
            }
        }

        $normalizeDate = function ($val): ?string {
            if (empty($val)) {
                return null;
            }
            $str = trim((string) $val);
            if ($str === '-' || str_starts_with($str, '0000-00-00')) {
                return null;
            }
            $datePart = substr($str, 0, 10);
            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $datePart) ? $datePart : null;
        };

        $isBpjs = stripos((string) ($reg->png_jawab ?? ''), 'BPJS') !== false || !empty($noSep);

        $items = [];

        // A. Asesmen Awal Keperawatan / Kebidanan (kondisional Anak vs Ibu)
        if ($isAnak) {
            $askepFilled = $isNeonatus ? ($askepNeonatus ?? $askepAnak) : ($askepAnak ?? $askepNeonatus);
            $items[] = [
                'key' => $isNeonatus ? 'askep_neonatus' : 'askep_anak',
                'label' => $isNeonatus ? 'Asesmen Awal Keperawatan Neonatus' : 'Asesmen Awal Keperawatan Anak',
                'category' => 'Asesmen Awal',
                'required' => true,
                'completed' => (bool) $askepFilled,
                'detail' => $askepFilled
                    ? ('Terisi' . ($extractDate($askepFilled) ? ' • ' . $extractDate($askepFilled) : ''))
                    : 'Belum diisi oleh perawat ruangan',
                'action' => $isNeonatus ? 'askep_neonatus' : 'askep_anak',
            ];
        } elseif ($isObgyn) {
            $items[] = [
                'key' => 'askep_kebidanan',
                'label' => 'Asesmen Awal Kebidanan Ranap',
                'category' => 'Asesmen Awal',
                'required' => true,
                'completed' => (bool) $askepKebidanan,
                'detail' => $askepKebidanan
                    ? ('Terisi' . ($extractDate($askepKebidanan) ? ' • ' . $extractDate($askepKebidanan) : ''))
                    : 'Belum diisi oleh bidan ruangan',
                'action' => 'askep_kebidanan',
            ];
        } else {
            $anyAskep = $askepKebidanan ?? $askepAnak ?? $askepNeonatus;
            $items[] = [
                'key' => 'askep_umum',
                'label' => 'Asesmen Awal Keperawatan / Kebidanan',
                'category' => 'Asesmen Awal',
                'required' => true,
                'completed' => (bool) $anyAskep,
                'detail' => $anyAskep
                    ? ('Terisi' . ($extractDate($anyAskep) ? ' • ' . $extractDate($anyAskep) : ''))
                    : 'Belum diisi',
                'action' => 'askep_kebidanan',
            ];
        }

        // B. Asesmen Awal Medis IGD
        $items[] = [
            'key' => 'asmed_igd',
            'label' => 'Asesmen Awal Medis (IGD)',
            'category' => 'Asesmen Awal',
            'required' => true,
            'completed' => (bool) $asmedIgd,
            'detail' => $asmedIgd
                ? ('Terisi' . ($extractDate($asmedIgd) ? ' • ' . $extractDate($asmedIgd) : ''))
                : 'Belum ada asesmen medis awal IGD',
            'action' => 'asmed_igd',
        ];

        // C. Asesmen Awal Medis Spesialis (Obgyn / Anak)
        if ($isObgyn) {
            $items[] = [
                'key' => 'asmed_obgyn',
                'label' => 'Asesmen Awal Medis Obgyn / Kandungan',
                'category' => 'Asesmen Awal',
                'required' => true,
                'completed' => (bool) $asmedObgyn,
                'detail' => $asmedObgyn
                    ? ('Terisi' . ($extractDate($asmedObgyn) ? ' • ' . $extractDate($asmedObgyn) : ''))
                    : 'Belum diisi dokter DPJP Obgyn',
                'action' => 'asmed_obgyn',
            ];
        } elseif ($isAnak) {
            $items[] = [
                'key' => 'asmed_anak',
                'label' => 'Asesmen Awal Medis Anak',
                'category' => 'Asesmen Awal',
                'required' => true,
                'completed' => (bool) $asmedAnak,
                'detail' => $asmedAnak
                    ? ('Terisi' . ($extractDate($asmedAnak) ? ' • ' . $extractDate($asmedAnak) : ''))
                    : 'Belum diisi dokter DPJP Anak',
                'action' => 'asmed_anak',
            ];
        } else {
            $items[] = [
                'key' => 'asmed_obgyn',
                'label' => 'Asesmen Awal Medis Obgyn',
                'category' => 'Asesmen Awal',
                'required' => false,
                'completed' => (bool) $asmedObgyn,
                'detail' => $asmedObgyn ? 'Terisi' : 'Tidak ada / Opsional',
                'action' => 'asmed_obgyn',
            ];
            $items[] = [
                'key' => 'asmed_anak',
                'label' => 'Asesmen Awal Medis Anak',
                'category' => 'Asesmen Awal',
                'required' => false,
                'completed' => (bool) $asmedAnak,
                'detail' => $asmedAnak ? 'Terisi' : 'Tidak ada / Opsional',
                'action' => 'asmed_anak',
            ];
        }

        // D. Plan of Care
        $items[] = [
            'key' => 'plan_of_care',
            'label' => 'Plan of Care (POC)',
            'category' => 'Asuhan Klinis',
            'required' => true,
            'completed' => (bool) $poc,
            'detail' => $poc
                ? ('Terisi' . ($extractDate($poc) ? ' • ' . $extractDate($poc) : ''))
                : 'Belum diisi',
            'action' => 'plan_of_care',
        ];

        // E. Asesmen Nyeri
        $items[] = [
            'key' => 'asesmen_nyeri',
            'label' => $nyeriSourceLabel,
            'category' => 'Asuhan Klinis',
            'required' => true,
            'completed' => (bool) $nyeriRow,
            'detail' => $nyeriRow
                ? ('Terisi' . ($extractDate($nyeriRow) ? ' • ' . $extractDate($nyeriRow) : ''))
                : 'Belum dilakukan asesmen nyeri',
            'action' => $nyeriTables[$nyeriKey]['action'],
        ];

        // F. Skoring & Skrining TB
        $tbParts = [];
        $tbParts[] = 'Skrining TB: ' . ($skriningTb ? 'Sudah' : 'Belum');
        $tbParts[] = 'Skoring TB: ' . ($skoringTb ? 'Sudah' : 'Belum');
        $items[] = [
            'key' => 'tb',
            'label' => 'Skoring & Skrining TB',
            'category' => 'Asuhan Klinis',
            'required' => true,
            'completed' => (bool) ($skriningTb || $skoringTb),
            'partial' => (bool) (($skriningTb && !$skoringTb) || (!$skriningTb && $skoringTb)),
            'detail' => implode(' • ', $tbParts),
            'action' => 'skoring_tb',
        ];

        // G. Discharge Planning
        $items[] = [
            'key' => 'discharge_planning',
            'label' => 'Discharge Planning',
            'category' => 'Kepulangan',
            'required' => true,
            'completed' => (bool) $discharge,
            'detail' => $discharge
                ? ('Terisi' . ($extractDate($discharge) ? ' • ' . $extractDate($discharge) : ''))
                : 'Belum diisi',
            'action' => 'discharge_planning',
        ];

        // H. Resume Medis
        $tglKontrolRes = $resume ? $normalizeDate($resume->kontrol ?? null) : null;
        $items[] = [
            'key' => 'resume_medis',
            'label' => 'Resume Medis Ranap',
            'category' => 'Kepulangan',
            'required' => true,
            'completed' => (bool) $resume,
            'detail' => $resume
                ? ('Terbit' . ($tglKontrolRes ? ' • Kontrol: ' . $tglKontrolRes : ''))
                : 'Belum terbit resume medis',
            'action' => 'resume_medis',
        ];

        // H2. Surat Kontrol BPJS (cocokkan no_rawat -> bridging_sep.no_sep -> bridging_surat_kontrol_bpjs.no_sep)
        $hasSuratKontrol = (bool) ($suratKontrol && !empty($suratKontrol->no_surat));
        $tglKontrolBpjs = $hasSuratKontrol ? $normalizeDate($suratKontrol->tgl_rencana ?? null) : null;
        $skTglMismatch = (bool) ($hasSuratKontrol && $resume && !empty($tglKontrolBpjs) && ($tglKontrolRes !== $tglKontrolBpjs));

        if ($hasSuratKontrol) {
            $skDetail = "SEP {$noSep} • SKRI: {$suratKontrol->no_surat}";
            if ($tglKontrolBpjs) {
                $skDetail .= " • Rencana: {$tglKontrolBpjs}";
            }
            if (!empty($suratKontrol->nm_poli_bpjs)) {
                $skDetail .= " • {$suratKontrol->nm_poli_bpjs}";
            }
            if ($skTglMismatch) {
                $skDetail .= ' • Tgl beda dg Resume (' . ($tglKontrolRes ?: 'Kosong') . ')';
            }
        } elseif (!empty($noSep)) {
            $skDetail = "SEP {$noSep} ditemukan, Surat Kontrol BPJS belum terbit";
        } elseif ($isBpjs) {
            $skDetail = 'Nomor SEP belum ditemukan untuk No. Rawat ini';
        } else {
            $skDetail = 'Pasien Non-BPJS (' . ($reg->png_jawab ?: 'Umum') . ') • Tidak wajib SKRI BPJS';
        }

        $items[] = [
            'key' => 'surat_kontrol',
            'label' => 'Surat Kontrol BPJS (SKRI)',
            'category' => 'Kepulangan',
            'required' => $isBpjs,
            'completed' => $hasSuratKontrol,
            'partial' => $skTglMismatch,
            'tgl_mismatch' => $skTglMismatch,
            'is_bpjs' => $isBpjs,
            'no_sep' => $noSep,
            'no_surat_kontrol' => $suratKontrol->no_surat ?? null,
            'tgl_rencana' => $tglKontrolBpjs,
            'tgl_kontrol_resume' => $tglKontrolRes,
            'nm_poli_bpjs' => $suratKontrol->nm_poli_bpjs ?? null,
            'nm_dokter_bpjs' => $suratKontrol->nm_dokter_bpjs ?? null,
            'detail' => $skDetail,
            'action' => 'surat_kontrol',
        ];

        // I. Penunjang Laboratorium (Kondisional)
        $hasLab = ($countPermintaanLab > 0 || $countHasilLab > 0);
        $items[] = [
            'key' => 'lab',
            'label' => 'Pemeriksaan Penunjang Laboratorium',
            'category' => 'Penunjang',
            'required' => false,
            'completed' => $hasLab,
            'detail' => $hasLab
                ? "{$countPermintaanLab} order permintaan • {$countHasilLab} entri hasil lab"
                : 'Belum ada order / hasil laboratorium',
            'action' => 'tab_lab',
        ];

        // J. Penunjang Radiologi (Kondisional)
        $hasRad = ($countPermintaanRad > 0 || $countHasilRad > 0 || $countPeriksaRad > 0);
        $items[] = [
            'key' => 'radiologi',
            'label' => 'Pemeriksaan Penunjang Radiologi',
            'category' => 'Penunjang',
            'required' => false,
            'completed' => $hasRad,
            'detail' => $hasRad
                ? "{$countPermintaanRad} order permintaan • " . max($countHasilRad, $countPeriksaRad) . " hasil radiologi"
                : 'Belum ada order / hasil radiologi',
            'action' => 'tab_radiologi',
        ];

        $requiredItems = array_values(array_filter($items, fn($it) => $it['required']));
        $requiredTotal = count($requiredItems);
        $requiredCompleted = count(array_filter($requiredItems, fn($it) => $it['completed']));
        $percent = $requiredTotal > 0 ? (int) round(($requiredCompleted / $requiredTotal) * 100) : 100;

        $tipePasien = $isNeonatus
            ? 'Neonatus (Anak)'
            : ($isAnak ? 'Pasien Anak' : ($isObgyn ? 'Pasien Ibu / Obgyn' : ($reg->nm_sps ?: 'Umum')));

        return response()->json([
            'success' => true,
            'pasien' => [
                'no_rawat' => $reg->no_rawat,
                'no_rkm_medis' => $reg->no_rkm_medis,
                'nm_pasien' => $reg->nm_pasien,
                'kd_sps' => $kdSps,
                'tipe_pasien' => $tipePasien,
                'png_jawab' => $reg->png_jawab ?? '-',
                'is_bpjs' => $isBpjs,
                'no_sep' => $noSep,
            ],
            'summary' => [
                'required_total' => $requiredTotal,
                'required_completed' => $requiredCompleted,
                'required_missing' => $requiredTotal - $requiredCompleted,
                'percent' => $percent,
                'total_items' => count($items),
            ],
            'items' => $items,
        ]);
    }

    /**
     * Ringkasan batch kelengkapan berkas utama untuk seluruh pasien sesuai filter tabel Ranap.
     * Dipakai oleh Floating Sticky Progress Bar di atas #tb_ranap & Floating Panel Kelengkapan Berkas.
     */
    public function kelengkapanBerkasBatch(Request $request)
    {
        $sttsPulang = $request->input('stts_pulang', '-');
        $tglAwal = $request->input('tgl_pertama');
        $tglAkhir = $request->input('tgl_kedua');

        $query = DB::table('kamar_inap as ki')
            ->join('reg_periksa as rp', 'rp.no_rawat', '=', 'ki.no_rawat')
            ->join('pasien as p', 'p.no_rkm_medis', '=', 'rp.no_rkm_medis')
            ->leftJoin('dokter as d', 'd.kd_dokter', '=', 'rp.kd_dokter')
            ->leftJoin('penjab as pj', 'pj.kd_pj', '=', 'rp.kd_pj')
            ->leftJoin('kamar as k', 'k.kd_kamar', '=', 'ki.kd_kamar')
            ->leftJoin('bangsal as b', 'b.kd_bangsal', '=', 'k.kd_bangsal')
            ->select([
                'ki.no_rawat',
                'ki.tgl_masuk',
                'ki.tgl_keluar',
                'ki.stts_pulang',
                'rp.no_rkm_medis',
                'rp.tgl_registrasi',
                'rp.sttsumur',
                'rp.kd_dokter',
                'rp.kd_pj',
                'p.nm_pasien',
                'p.tgl_lahir',
                'd.nm_dokter',
                'd.kd_sps',
                'pj.png_jawab',
                'b.nm_bangsal',
            ])
            ->orderByDesc('ki.no_rawat');

        if ($sttsPulang === '-') {
            $query->where('ki.stts_pulang', '-');
        } elseif ($sttsPulang === 'Masuk' && $tglAwal && $tglAkhir) {
            $query->whereBetween('ki.tgl_masuk', [$tglAwal, $tglAkhir])
                ->where('ki.stts_pulang', '!=', 'Pindah Kamar');
        } elseif ($sttsPulang === 'Pulang' && $tglAwal && $tglAkhir) {
            $query->whereBetween('ki.tgl_keluar', [$tglAwal, $tglAkhir])
                ->whereNotIn('ki.stts_pulang', ['-', 'Pindah Kamar']);
        } elseif ($sttsPulang === 'Rujuk' && $tglAwal && $tglAkhir) {
            $query->whereBetween('ki.tgl_keluar', [$tglAwal, $tglAkhir])
                ->where('ki.stts_pulang', 'like', '%Rujuk%');
        } else {
            $query->where('ki.stts_pulang', '-');
        }

        if ($request->filled('kd_dokter')) {
            $query->where('rp.kd_dokter', $request->kd_dokter);
        }
        if ($request->filled('spesialis')) {
            $query->where('d.kd_sps', $request->spesialis);
        }
        if ($request->filled('kamar')) {
            $query->where('b.nm_bangsal', 'like', '%' . $request->kamar . '%');
        }

        $rows = $query->limit(250)->get()->unique('no_rawat')->values();

        if ($rows->isEmpty()) {
            return response()->json([
                'success' => true,
                'summary' => [
                    'total_pasien' => 0,
                    'avg_percent' => 0,
                    'lengkap_penuh' => 0,
                    'belum_lengkap' => 0,
                    'per_berkas' => [],
                ],
                'items' => [],
            ]);
        }

        $noRawats = $rows->pluck('no_rawat')->all();

        $fetchSet = function (string $table) use ($noRawats): array {
            try {
                return array_flip(
                    DB::table($table)
                        ->whereIn('no_rawat', $noRawats)
                        ->distinct()
                        ->pluck('no_rawat')
                        ->all()
                );
            } catch (\Throwable $e) {
                return [];
            }
        };

        $fetchCounts = function (string $table) use ($noRawats): array {
            try {
                return DB::table($table)
                    ->whereIn('no_rawat', $noRawats)
                    ->select('no_rawat', DB::raw('COUNT(*) as total'))
                    ->groupBy('no_rawat')
                    ->pluck('total', 'no_rawat')
                    ->map(fn($v) => (int) $v)
                    ->all();
            } catch (\Throwable $e) {
                return [];
            }
        };

        // Batch indexed lookups (zero N+1)
        $setAskepAnak = $fetchSet('penilaian_awal_keperawatan_ranap_anak');
        $setAskepNeonatus = $fetchSet('penilaian_awal_keperawatan_ranap_neonatus');
        $setAskepKebidanan = $fetchSet('penilaian_awal_keperawatan_kebidanan_ranap');
        $setAsmedIgd = $fetchSet('penilaian_medis_igd');
        $setAsmedObgyn = $fetchSet('penilaian_medis_ranap_kandungan');
        $setAsmedAnak = $fetchSet('penilaian_medis_ranap');
        $mapResumeKontrol = [];
        try {
            $mapResumeKontrol = DB::table('resume_pasien_ranap')
                ->whereIn('no_rawat', $noRawats)
                ->pluck('kontrol', 'no_rawat')
                ->all();
        } catch (\Throwable $e) {
            $mapResumeKontrol = [];
        }
        $setPoc = $fetchSet('plan_of_care');
        $setDischarge = $fetchSet('rsia_discharge_planning');
        $setSkoringTb = $fetchSet('rsia_skoring_tb');
        $setSkriningTb = $fetchSet('rsia_skrining_tb');

        // Batch SEP (prioritas jnspelayanan = '1' / Ranap) & Surat Kontrol BPJS per no_sep
        $sepByNoRawat = collect();
        try {
            $sepByNoRawat = DB::table('bridging_sep')
                ->whereIn('no_rawat', $noRawats)
                ->select(['no_rawat', 'no_sep', 'jnspelayanan', 'tglsep'])
                ->orderByRaw("CASE WHEN jnspelayanan = '1' THEN 0 ELSE 1 END ASC")
                ->orderByDesc('tglsep')
                ->get()
                ->groupBy('no_rawat')
                ->map(fn($group) => $group->first());
        } catch (\Throwable $e) {
            $sepByNoRawat = collect();
        }

        $noSeps = $sepByNoRawat->pluck('no_sep')->filter()->unique()->values()->all();
        $suratKontrolBySep = collect();
        if (!empty($noSeps)) {
            try {
                $suratKontrolBySep = DB::table('bridging_surat_kontrol_bpjs')
                    ->whereIn('no_sep', $noSeps)
                    ->select(['no_sep', 'no_surat', 'tgl_surat', 'tgl_rencana', 'nm_poli_bpjs', 'nm_dokter_bpjs'])
                    ->orderByDesc('tgl_surat')
                    ->orderByDesc('tgl_rencana')
                    ->get()
                    ->groupBy('no_sep')
                    ->map(fn($group) => $group->first());
            } catch (\Throwable $e) {
                $suratKontrolBySep = collect();
            }
        }

        $normalizeBatchDate = function ($val): ?string {
            if (empty($val)) {
                return null;
            }
            $str = trim((string) $val);
            if ($str === '-' || str_starts_with($str, '0000-00-00')) {
                return null;
            }
            $datePart = substr($str, 0, 10);
            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $datePart) ? $datePart : null;
        };

        $setNyeriNeo = $fetchSet('rsia_asesmen_nyeri_neonatal');
        $setNyeriBatita = $fetchSet('rsia_asesmen_nyeri_anak_1bl3th');
        $setNyeriBalita = $fetchSet('rsia_asesmen_nyeri_anak_3th7th');
        $setNyeriAnak = $fetchSet('rsia_asesmen_nyeri_anak_7th');
        $setNyeriDewasa = $fetchSet('rsia_asesmen_nyeri_dewasa');

        $cntPermLab = $fetchCounts('permintaan_lab');
        $cntHasilLab = $fetchCounts('periksa_lab');
        $cntPermRad = $fetchCounts('permintaan_radiologi');
        $cntHasilRad = $fetchCounts('hasil_radiologi');
        $cntPeriksaRad = $fetchCounts('periksa_radiologi');

        $perBerkas = [
            'askep' => ['label' => 'Askep Awal', 'done' => 0, 'total' => 0, 'required' => true],
            'asmed_igd' => ['label' => 'Asmed IGD', 'done' => 0, 'total' => 0, 'required' => true],
            'asmed_sps' => ['label' => 'Asmed Obgyn/Anak', 'done' => 0, 'total' => 0, 'required' => true],
            'poc' => ['label' => 'Plan of Care', 'done' => 0, 'total' => 0, 'required' => true],
            'nyeri' => ['label' => 'Asesmen Nyeri', 'done' => 0, 'total' => 0, 'required' => true],
            'tb' => ['label' => 'TB (Skor/Skrin)', 'done' => 0, 'total' => 0, 'required' => true],
            'discharge' => ['label' => 'Discharge Plan', 'done' => 0, 'total' => 0, 'required' => true],
            'resume' => ['label' => 'Resume Medis', 'done' => 0, 'total' => 0, 'required' => true],
            'surat_kontrol' => ['label' => 'Surat Kontrol', 'done' => 0, 'total' => 0, 'required' => true],
            'lab' => ['label' => 'Penunjang Lab', 'done' => 0, 'total' => 0, 'required' => false],
            'rad' => ['label' => 'Penunjang Rad', 'done' => 0, 'total' => 0, 'required' => false],
        ];

        $items = [];
        $sumPercent = 0;
        $lengkapPenuh = 0;

        foreach ($rows as $r) {
            $nr = $r->no_rawat;
            $kdSps = trim((string) ($r->kd_sps ?? ''));
            $isAnak = $kdSps === 'S0003';
            $isObgyn = $kdSps === 'S0001';

            $totalHari = 99999;
            if (!empty($r->tgl_lahir) && !empty($r->tgl_registrasi)) {
                try {
                    $totalHari = Carbon::parse($r->tgl_lahir)->diffInDays(Carbon::parse($r->tgl_registrasi));
                } catch (\Throwable $e) {
                    $totalHari = 99999;
                }
            }
            $isNeonatus = $isAnak && ($r->sttsumur === 'Hr' || $totalHari <= 28);

            // 1. Askep
            if ($isAnak) {
                $askepOk = isset($setAskepAnak[$nr]) || isset($setAskepNeonatus[$nr]);
                $askepShort = $isNeonatus ? 'Askep Neo' : 'Askep Anak';
                $askepAction = $isNeonatus ? 'askep_neonatus' : 'askep_anak';
            } elseif ($isObgyn) {
                $askepOk = isset($setAskepKebidanan[$nr]);
                $askepShort = 'Askep Bidan';
                $askepAction = 'askep_kebidanan';
            } else {
                $askepOk = isset($setAskepKebidanan[$nr]) || isset($setAskepAnak[$nr]) || isset($setAskepNeonatus[$nr]);
                $askepShort = 'Askep Awal';
                $askepAction = 'askep_kebidanan';
            }

            // 2. Asmed IGD
            $asmedIgdOk = isset($setAsmedIgd[$nr]);

            // 3. Asmed Obgyn / Anak
            if ($isObgyn) {
                $asmedSpsOk = isset($setAsmedObgyn[$nr]);
                $asmedSpsShort = 'Asmed Obgyn';
                $asmedSpsAction = 'asmed_obgyn';
            } elseif ($isAnak) {
                $asmedSpsOk = isset($setAsmedAnak[$nr]);
                $asmedSpsShort = 'Asmed Anak';
                $asmedSpsAction = 'asmed_anak';
            } else {
                $asmedSpsOk = isset($setAsmedObgyn[$nr]) || isset($setAsmedAnak[$nr]);
                $asmedSpsShort = 'Asmed Sps';
                $asmedSpsAction = 'asmed_obgyn';
            }

            // 4. POC
            $pocOk = isset($setPoc[$nr]);

            // 5. Asesmen Nyeri
            $nyeriOk = isset($setNyeriNeo[$nr]) || isset($setNyeriBatita[$nr]) || isset($setNyeriBalita[$nr])
                || isset($setNyeriAnak[$nr]) || isset($setNyeriDewasa[$nr]);
            if ($totalHari <= 28) {
                $nyeriAction = 'nyeri_neonatus';
            } elseif ($totalHari <= 3 * 365) {
                $nyeriAction = 'nyeri_batita';
            } elseif ($totalHari <= 7 * 365) {
                $nyeriAction = 'nyeri_balita';
            } elseif ($totalHari <= 13 * 365) {
                $nyeriAction = 'nyeri_anak';
            } else {
                $nyeriAction = 'nyeri_dewasa';
            }

            // 6. TB
            $tbOk = isset($setSkriningTb[$nr]) || isset($setSkoringTb[$nr]);

            // 7. Discharge Planning
            $dischargeOk = isset($setDischarge[$nr]);

            // 8. Resume Medis
            $resumeOk = array_key_exists($nr, $mapResumeKontrol);
            $tglKontrolRes = $resumeOk ? $normalizeBatchDate($mapResumeKontrol[$nr] ?? null) : null;

            // 8b. Surat Kontrol BPJS (cocokkan no_rawat -> bridging_sep.no_sep -> bridging_surat_kontrol_bpjs.no_sep)
            $sepRow = $sepByNoRawat->get($nr);
            $noSep = $sepRow->no_sep ?? null;
            $skRow = $noSep ? $suratKontrolBySep->get($noSep) : null;
            $isBpjs = stripos((string) ($r->png_jawab ?? ''), 'BPJS') !== false || !empty($noSep);
            $skOk = (bool) ($skRow && !empty($skRow->no_surat));
            $tglKontrolBpjs = $skOk ? $normalizeBatchDate($skRow->tgl_rencana ?? null) : null;
            $skMismatch = (bool) ($skOk && $resumeOk && !empty($tglKontrolBpjs) && ($tglKontrolRes !== $tglKontrolBpjs));

            // 9. Lab & Rad (kondisional)
            $labOk = (($cntPermLab[$nr] ?? 0) > 0) || (($cntHasilLab[$nr] ?? 0) > 0);
            $radOk = (($cntPermRad[$nr] ?? 0) > 0) || (($cntHasilRad[$nr] ?? 0) > 0) || (($cntPeriksaRad[$nr] ?? 0) > 0);

            $berkas = [
                ['key' => 'askep', 'short' => $askepShort, 'required' => true, 'completed' => $askepOk, 'action' => $askepAction],
                ['key' => 'asmed_igd', 'short' => 'Asmed IGD', 'required' => true, 'completed' => $asmedIgdOk, 'action' => 'asmed_igd'],
                ['key' => 'asmed_sps', 'short' => $asmedSpsShort, 'required' => true, 'completed' => $asmedSpsOk, 'action' => $asmedSpsAction],
                ['key' => 'poc', 'short' => 'POC', 'required' => true, 'completed' => $pocOk, 'action' => 'plan_of_care'],
                ['key' => 'nyeri', 'short' => 'Nyeri', 'required' => true, 'completed' => $nyeriOk, 'action' => $nyeriAction],
                ['key' => 'tb', 'short' => 'TB', 'required' => true, 'completed' => $tbOk, 'action' => 'skoring_tb'],
                ['key' => 'discharge', 'short' => 'Discharge', 'required' => true, 'completed' => $dischargeOk, 'action' => 'discharge_planning'],
                ['key' => 'resume', 'short' => 'Resume', 'required' => true, 'completed' => $resumeOk, 'action' => 'resume_medis'],
                [
                    'key' => 'surat_kontrol',
                    'short' => 'SKRI',
                    'required' => $isBpjs,
                    'completed' => $skOk,
                    'partial' => $skMismatch,
                    'tgl_mismatch' => $skMismatch,
                    'is_bpjs' => $isBpjs,
                    'no_sep' => $noSep,
                    'no_surat_kontrol' => $skRow->no_surat ?? null,
                    'tgl_rencana' => $tglKontrolBpjs,
                    'tgl_kontrol_resume' => $tglKontrolRes,
                    'nm_poli_bpjs' => $skRow->nm_poli_bpjs ?? null,
                    'nm_dokter_bpjs' => $skRow->nm_dokter_bpjs ?? null,
                    'action' => 'surat_kontrol',
                ],
                ['key' => 'lab', 'short' => 'Lab', 'required' => false, 'completed' => $labOk, 'action' => 'penunjang'],
                ['key' => 'rad', 'short' => 'Rad', 'required' => false, 'completed' => $radOk, 'action' => 'penunjang'],
            ];

            $reqTotal = 0;
            $reqDone = 0;
            foreach ($berkas as $b) {
                $k = $b['key'];
                if ($k === 'surat_kontrol') {
                    if ($b['required']) {
                        $perBerkas[$k]['total']++;
                        if ($b['completed']) {
                            $perBerkas[$k]['done']++;
                        }
                    }
                } else {
                    $perBerkas[$k]['total']++;
                    if ($b['completed']) {
                        $perBerkas[$k]['done']++;
                    }
                }
                if ($b['required']) {
                    $reqTotal++;
                    if ($b['completed']) {
                        $reqDone++;
                    }
                }
            }

            $pct = $reqTotal > 0 ? (int) round(($reqDone / $reqTotal) * 100) : 100;
            $sumPercent += $pct;
            if ($reqDone === $reqTotal) {
                $lengkapPenuh++;
            }

            $items[] = [
                'no_rawat' => $nr,
                'no_rkm_medis' => $r->no_rkm_medis,
                'nm_pasien' => $r->nm_pasien,
                'nm_bangsal' => $r->nm_bangsal ?? '-',
                'nm_dokter' => $r->nm_dokter ?? '-',
                'tipe_pasien' => $isNeonatus ? 'Neonatus' : ($isAnak ? 'Anak' : ($isObgyn ? 'Ibu/Obgyn' : 'Umum')),
                'percent' => $pct,
                'required_completed' => $reqDone,
                'required_total' => $reqTotal,
                'required_missing' => $reqTotal - $reqDone,
                'berkas' => $berkas,
            ];
        }

        // Urutkan pasien dengan persentase kelengkapan terendah di atas agar cepat ditindaklanjuti
        usort($items, fn($a, $b) => $a['percent'] <=> $b['percent']);

        $totalPasien = count($items);
        $avgPercent = $totalPasien > 0 ? (int) round($sumPercent / $totalPasien) : 0;

        $perBerkasList = [];
        foreach ($perBerkas as $k => $v) {
            $perBerkasList[] = [
                'key' => $k,
                'label' => $v['label'],
                'required' => $v['required'],
                'done' => $v['done'],
                'total' => $v['total'],
                'percent' => $v['total'] > 0 ? (int) round(($v['done'] / $v['total']) * 100) : 0,
            ];
        }

        return response()->json([
            'success' => true,
            'summary' => [
                'total_pasien' => $totalPasien,
                'avg_percent' => $avgPercent,
                'lengkap_penuh' => $lengkapPenuh,
                'belum_lengkap' => $totalPasien - $lengkapPenuh,
                'per_berkas' => $perBerkasList,
            ],
            'items' => $items,
        ]);
    }

    /**
     * Ringkasan KPI Rawat Inap sesuai rentang tanggal & filter tabel aktif:
     * - Sedang Dirawat (aktif saat ini)
     * - Pasien Baru Masuk (pada periode filter / hari ini)
     * - Pasien Pulang (pada periode filter / hari ini)
     * - Pasien Rujuk (pada periode filter / hari ini)
     */
    public function statistik(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $tglAwal = $request->filled('tgl_pertama') ? $request->tgl_pertama : $today;
        $tglAkhir = $request->filled('tgl_kedua') ? $request->tgl_kedua : $today;

        $applyCommonFilters = function ($q) use ($request) {
            $q->join('reg_periksa as rp', 'rp.no_rawat', '=', 'ki.no_rawat')
                ->leftJoin('dokter as d', 'd.kd_dokter', '=', 'rp.kd_dokter')
                ->leftJoin('kamar as k', 'k.kd_kamar', '=', 'ki.kd_kamar')
                ->leftJoin('bangsal as b', 'b.kd_bangsal', '=', 'k.kd_bangsal');

            if ($request->filled('kd_dokter')) {
                $q->where('rp.kd_dokter', $request->kd_dokter);
            }
            if ($request->filled('spesialis')) {
                $q->where('d.kd_sps', $request->spesialis);
            }
            if ($request->filled('kamar')) {
                $q->where('b.nm_bangsal', 'like', '%' . $request->kamar . '%');
            }
            return $q;
        };

        $sedangDirawat = (int) $applyCommonFilters(DB::table('kamar_inap as ki'))
            ->where('ki.stts_pulang', '-')
            ->distinct('ki.no_rawat')
            ->count('ki.no_rawat');

        $baruMasuk = (int) $applyCommonFilters(DB::table('kamar_inap as ki'))
            ->whereBetween('ki.tgl_masuk', [$tglAwal, $tglAkhir])
            ->where('ki.stts_pulang', '!=', 'Pindah Kamar')
            ->distinct('ki.no_rawat')
            ->count('ki.no_rawat');

        $pasienPulang = (int) $applyCommonFilters(DB::table('kamar_inap as ki'))
            ->whereBetween('ki.tgl_keluar', [$tglAwal, $tglAkhir])
            ->whereNotIn('ki.stts_pulang', ['-', 'Pindah Kamar'])
            ->where('ki.tgl_keluar', '!=', '0000-00-00')
            ->distinct('ki.no_rawat')
            ->count('ki.no_rawat');

        $pasienRujuk = (int) $applyCommonFilters(DB::table('kamar_inap as ki'))
            ->whereBetween('ki.tgl_keluar', [$tglAwal, $tglAkhir])
            ->where('ki.tgl_keluar', '!=', '0000-00-00')
            ->where('ki.stts_pulang', 'like', '%Rujuk%')
            ->distinct('ki.no_rawat')
            ->count('ki.no_rawat');

        return response()->json([
            'success' => true,
            'periode' => [
                'awal' => $tglAwal,
                'akhir' => $tglAkhir,
                'is_today' => ($tglAwal === $today && $tglAkhir === $today),
            ],
            'stats' => [
                'sedang_dirawat' => $sedangDirawat,
                'baru_masuk' => $baruMasuk,
                'pulang' => $pasienPulang,
                'rujuk' => $pasienRujuk,
            ],
        ]);
    }
}
