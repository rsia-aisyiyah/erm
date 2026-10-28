<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;
use App\Models\ResepObat;
use App\Models\DataBarang;
use App\Models\DetailPemberianObat;
use App\Models\AturanPakai;
use App\Models\GudangBarang;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ResepObatController extends Controller
{
    use ResponseTrait;
    private $resepObat;
    private $track;

    protected string $logChannel = 'resep-log';
    public function __construct()
    {
        $this->resepObat = new ResepObat();
        $this->track = new TrackerSqlController();
    }
    public function index()
    {
        return view('content.farmasi.ralan.resep');
    }
    public function delete($noResep)
    {
        $resepObat = $this->resepObat;
        $data = ['no_resep' => $noResep];

        try {
            $result = $resepObat->where($data);
            $isValidated = $result->first()->tgl_perawatan !== '0000-00-00' ? true : false;
            $isSubmitted = $result->first()->tgl_penyerahan !== '0000-00-00' ? true : false;
            if ($isValidated || $isSubmitted) {
                return response()->json(['message' => 'Obat sudah divalidasi / diserahkan'], 500);
            }

            $result->delete();
            if ($result) {
                $this->track->deleteSql($resepObat, $data);
            }
        } catch (QueryException $e) {
            return $this->errorResponse($e, $e->getMessage(), 500);
        }
        return response()->json($result);
    }

    function getByNoRawat($no_rawat)
    {
        $id = str_replace('-', '/', $no_rawat);
        $resepObat = $this->resepObat->where('no_rawat', $id)
            ->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')
            ->get();

        return response()->json($resepObat);
    }
    function get($no_resep)
    {
        $resepObat = $this->resepObat->where('no_resep', $no_resep)
            ->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detail.databarang.kodeSatuan')
            ->first();
        return response()->json($resepObat);
    }
    public function ambil(Request $request)
    {
        $resepObat = $this->resepObat->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan');

        if ($request->no_rawat) {

            $resepObat = $this->resepObat->where('no_rawat', $request->no_rawat);
            if ($request->status === 'ranap') {
                $resepObat = $resepObat->where('tgl_peresepan', date('Y-m-d'));
            }
            $resepObat = $resepObat->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->get();
        }
        if ($request->no_resep) {
            $resepObat = $this->resepObat->where('no_resep', $request->no_resep)
                ->where('status', $request->status)->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->first();
        }
        return response()->json($resepObat);
    }
    public function panggil(Request $request)
    {
        $jam = ($request->jam == 'true' || ($request->jam && $request->jam != '00:00:00')) ? date('H:i:s') : '00:00:00';
        $resepObat = $this->resepObat->where('no_resep', $request->no_resep)->update([
            'tgl_penyerahan' => $request->tanggal,
            'jam_penyerahan' => $jam,
        ]);

        $this->track->updateSql($this->resepObat, [
            'tgl_penyerahan' => $request->tanggal,
            'jam_penyerahan' => $jam,
        ], [
            'no_resep' =>
                $request->no_resep
        ]);

        return response()->json('Berhasil dipanggil');
    }
    public function ambilSekarang()
    {
        $resepObat = $this->resepObat->where('tgl_peresepan', date('Y-m-d'))
            ->where('status', 'ralan')
            ->with(['regPeriksa.pasien', 'regPeriksa.poliklinik'])
            ->get();
        return response()->json($resepObat);
    }

    public function getResepRanap(Request $request)
    {
        $tglAwal = $request->tgl_awal ?: date('Y-m-d');
        $tglAkhir = $request->tgl_akhir ?: date('Y-m-d');
        $status = $request->status;
        $keyword = $request->keyword;

        $query = $this->resepObat->query()
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.penjab',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'telaahFarmasi',
            ])
            ->where('status', 'ranap')
            ->whereBetween('tgl_peresepan', [$tglAwal, $tglAkhir]);

        if ($status === 'Belum') {
            $query->where('tgl_perawatan', '0000-00-00');
        } elseif ($status === 'Sudah') {
            $query->where('tgl_perawatan', '<>', '0000-00-00');
        }

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('no_resep', 'like', "%{$keyword}%")
                    ->orWhere('no_rawat', 'like', "%{$keyword}%")
                    ->orWhereHas('regPeriksa.pasien', function ($qp) use ($keyword) {
                        $qp->where('nm_pasien', 'like', "%{$keyword}%")
                            ->orWhere('no_rkm_medis', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('dokter', function ($qd) use ($keyword) {
                        $qd->where('nm_dokter', 'like', "%{$keyword}%");
                    });
            });
        }

        $data = $query->orderBy('tgl_peresepan', 'desc')
            ->orderBy('jam_peresepan', 'desc')
            ->get();

        return response()->json($data);
    }
    public function ambilTable(Request $request)
    {
        $resepObat = $this->resepObat
            ->where(function ($q) use ($request) {
                $q->where('tgl_peresepan', date('Y-m-d', strtotime($request->tgl_peresepan)))
                  ->orWhere('tgl_penyerahan', date('Y-m-d', strtotime($request->tgl_penyerahan)));
            })
            ->where('status', 'ralan')
            ->with(['regPeriksa.pasien', 'regPeriksa.poliklinik', 'regPeriksa.dokter.spesialis', 'telaahFarmasi'])
            ->orderBy('jam_peresepan', 'DESC');

        return DataTables::of($resepObat)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('regPeriksa.pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })
            ->make(true);
    }
    public function getLast()
    {
        $resepObat = $this->resepObat->select('no_resep');
        $result = $resepObat->where('tgl_peresepan', date('Y-m-d'))->orWhere('tgl_perawatan', date('Y-m-d'))->orderBy('no_resep', 'DESC')->first();
        return response()->json($result);
    }
    public function akhir(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->tgl_peresepan) {
            $result = $resepObat->where('tgl_peresepan', $request->tgl_peresepan)->orWhere('tgl_perawatan', $request->tgl_perawatan)->orderBy('no_resep', 'DESC')->first();
        }

        return response()->json($result);
    }
    public function create(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep ?: $this->generateNoResep(),
            'kd_dokter' => $request->kd_dokter,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => '0000-00-00',
            'jam' => '00:00:00',
            'tgl_peresepan' => Carbon::now()->toDateString(),
            'jam_peresepan' => Carbon::now()->toTimeString(),
            'status' => $request->status ? $request->status : 'ralan',
            'tgl_penyerahan' => '0000-00-00',
            'jam_penyerahan' => '00:00:00',
        ];

        try {

            $create = $this->createResep($data);
            return $this->successResponse($create, 'Berhasil membuat resep');
        } catch (QueryException $e) {
            return $this->errorResponse($e, $e->getMessage(), 500);
        }
    }

    private function createResep(array $data)
    {
        $create = $this->resepObat->create($data);

        if ($create) {
            $this->track->insertSql($this->resepObat, $data);
        }

        return $create;
    }


    function updateTime($no_resep)
    {
        $resep = $this->resepObat->where('no_resep', $no_resep)->update(['jam_peresepan' => date('H:i:s')]);
        return $resep;
    }

    function isAvailable($no_rawat)
    {
        $resep = $this->resepObat->where('no_rawat', $no_rawat)->first();
        return $resep;
    }

    function getByNoRm($no_rkm_medis)
    {
        $resep = $this->resepObat->whereHas('regPeriksa.pasien', function ($query) use ($no_rkm_medis) {
            return $query->where('no_rkm_medis', $no_rkm_medis);
        })->with(['resepRacikan.detail.databarang.kodeSatuan', 'resepRacikan.metode', 'resepDokter.dataBarang.kodeSatuan'])
            ->orderBy('tgl_peresepan', 'DESC')
            ->limit(15)
            ->get();

        return response()->json($resep);
    }

    private function generateNoResep()
    {
        $resep = ResepObat::select('no_resep')
            ->where('tgl_peresepan', date('Y-m-d'))
            ->orWhere('tgl_perawatan', date('Y-m-d'))
            ->orderBy('no_resep', 'DESC')->first();
        if ($resep) {
            return (int) $resep->no_resep + 1;

        }
        return (int) date('Ymd') . '0001';
    }

    public function copyResep($no_resep, Request $request)
    {
        try {
            // 1. Ambil template resep asal di luar transaksi
            $get = $this->get($no_resep);
            $template = json_decode($get->content());

            if (!$template) {
                throw new \Exception("Data resep asal tidak ditemukan.");
            }

            $now = Carbon::now();

            // 2. Mulai Transaksi
            return DB::transaction(function () use ($request, $template, $now) {

                // Cek apakah sudah ada resep untuk no_rawat ini (Locking)
                $resep = ResepObat::where('no_rawat', $request->no_rawat)
                    ->where('status', $request->status ?? 'ralan')
                    ->lockForUpdate()
                    ->first();

                $noResepExist = $resep?->no_resep;
                $no = $noResepExist ?: $this->generateNoResep();

                // Jika resep induk belum ada, buat baru
                if (!$noResepExist) {
                    $this->createResep([
                        'no_resep' => $no,
                        'kd_dokter' => $request->kd_dokter,
                        'no_rawat' => $request->no_rawat,
                        'tgl_perawatan' => '0000-00-00',
                        'jam' => '00:00:00',
                        'tgl_peresepan' => $now->toDateString(),
                        'jam_peresepan' => $now->toTimeString(),
                        'status' => $request->status ?? 'ralan',
                        'tgl_penyerahan' => '0000-00-00',
                        'jam_penyerahan' => '00:00:00',
                    ]);
                }

                // --- MAPPING DATA ---

                // A. Resep Dokter (Obat Jadi)
                $dataDokter = collect($template->resep_dokter)->map(fn($item) => [
                    'no_resep' => $no,
                    'kode_brng' => $item->kode_brng,
                    'jml' => $item->jml,
                    'aturan_pakai' => $item->aturan_pakai,
                ]);

                // B. Resep Racikan
                $lastNoRacik = ResepDokterRacikan::where('no_resep', $no)->max('no_racik') ?? 0;

                $dataRacikanHeader = [];
                $dataRacikanDetail = [];

                foreach ($template->resep_racikan as $index => $racik) {
                    $currentNoRacik = $lastNoRacik + $index + 1;

                    $dataRacikanHeader[] = [
                        'no_resep' => $no,
                        'no_racik' => $currentNoRacik,
                        'kd_racik' => $racik->kd_racik,
                        'nama_racik' => $racik->nama_racik,
                        'jml_dr' => $racik->jml_dr,
                        'aturan_pakai' => $racik->aturan_pakai,
                        'keterangan' => $racik->keterangan,
                    ];

                    foreach ($racik->detail as $det) {
                        $dataRacikanDetail[] = [
                            'no_resep' => $no,
                            'no_racik' => $currentNoRacik,
                            'kode_brng' => $det->kode_brng,
                            'jml' => $det->jml,
                            'p1' => $det->p1,
                            'p2' => $det->p2,
                            'kandungan' => $det->kandungan,
                        ];
                    }
                }

                // --- EKSEKUSI INSERT ---

                if ($dataDokter->isEmpty() && empty($dataRacikanHeader)) {
                    throw new \Exception("Template resep kosong (tidak ada obat/racikan)");
                }

                if ($dataDokter->isNotEmpty()) {
                    ResepDokter::insert($dataDokter->toArray());
                }

                if (!empty($dataRacikanHeader)) {
                    ResepDokterRacikan::insert($dataRacikanHeader);
                    ResepDokterRacikanDetail::insert($dataRacikanDetail);
                }

                $logDetail = [
                    'no_resep' => $no,
                    'reqeuest' => $request->all(),
                    'item_obat' => $dataDokter->map(fn($rd) => $rd['kode_brng'])->toArray(),
                    'item_racikan' => collect($dataRacikanHeader)->map(fn($rh) => $rh['nama_racik'])->toArray(),
                    'jumlah_item' => $dataDokter->count() + count($dataRacikanHeader)
                ];

                return $this->successResponse([
                    'detail' => $logDetail,
                ], 'Berhasil menyalin resep');
            });

        } catch (\Throwable $e) {
            return $this->errorResponse($e, "Gagal menyalin resep: " . $e->getMessage(), 500);
        }
    }

    public function getDetailRalan($no_resep)
    {
        $resep = $this->resepObat->where('no_resep', $no_resep)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.poliklinik',
                'regPeriksa.dokter.spesialis',
                'resepDokter.dataBarang.kodeSatuan',
                'resepRacikan.metode',
            ])->first();

        if (!$resep) {
            return response()->json(['message' => 'Data resep tidak ditemukan'], 404);
        }

        // Tentukan depo bangsal berdasarkan status resep (Ranap = RM, Ralan = set_depo_ralan / RM7)
        if ($resep->status === 'ranap') {
            $kdBangsal = 'RM';
            $nmBangsal = 'Depo Farmasi Ranap';
        } else {
            $kdPoli = $resep->regPeriksa->kd_poli ?? '';
            $depoPoli = DB::table('set_depo_ralan')->where('kd_poli', $kdPoli)->first();
            $kdBangsal = $depoPoli->kd_bangsal ?? 'RM7';
            $nmBangsal = DB::table('bangsal')->where('kd_bangsal', $kdBangsal)->value('nm_bangsal') ?? 'Apotek Rajal';
        }

        // Ambil pengaturan embalase dan tuslah
        $setEmbalase = DB::table('set_embalase')->first();
        $embalasePerObat = (float)($setEmbalase->embalase_per_obat ?? 0);
        $tuslahPerObat = (float)($setEmbalase->tuslah_per_obat ?? 0);

        // Ambil stok depo untuk setiap item non-racikan
        $items = [];
        if ($resep->resepDokter) {
            foreach ($resep->resepDokter as $rd) {
                $stok = DB::table('gudangbarang')
                    ->where('kode_brng', $rd->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->value('stok') ?? 0;

                $harga = ($rd->dataBarang->ralan ?? 0) > 0 ? $rd->dataBarang->ralan : ($rd->dataBarang->h_beli ?? 0);
                $biayaObat = (float)($harga * $rd->jml);
                $subtotal = $biayaObat + $embalasePerObat + $tuslahPerObat;

                $items[] = [
                    'kode_brng' => $rd->kode_brng,
                    'nama_brng' => $rd->dataBarang->nama_brng ?? $rd->kode_brng,
                    'satuan' => $rd->dataBarang->kodeSatuan->satuan ?? ($rd->dataBarang->kode_sat ?? ''),
                    'jml' => (float)$rd->jml,
                    'aturan_pakai' => $rd->aturan_pakai ?? '',
                    'stok_depo' => (float)$stok,
                    'harga' => (float)$harga,
                    'biaya_obat' => $biayaObat,
                    'embalase' => $embalasePerObat,
                    'tuslah' => $tuslahPerObat,
                    'total' => (float)$subtotal,
                ];
            }
        }

        // Ambil data racikan terstruktur beserta detail item, harga, dan stok depo
        $racikans = [];
        if ($resep->resepRacikan) {
            foreach ($resep->resepRacikan as $rr) {
                $details = ResepDokterRacikanDetail::where('no_resep', $no_resep)
                    ->where('no_racik', $rr->no_racik)
                    ->with('dataBarang.kodeSatuan')
                    ->get();

                $detailItems = [];
                $totalBiayaRacik = 0;
                foreach ($details as $det) {
                    $stok = DB::table('gudangbarang')
                        ->where('kode_brng', $det->kode_brng)
                        ->where('kd_bangsal', $kdBangsal)
                        ->value('stok') ?? 0;

                    $harga = ($det->dataBarang->ralan ?? 0) > 0 ? $det->dataBarang->ralan : ($det->dataBarang->h_beli ?? 0);
                    $biayaObat = (float)($harga * $det->jml);
                    $subtotal = $biayaObat + $embalasePerObat + $tuslahPerObat;
                    $totalBiayaRacik += $subtotal;

                    $detailItems[] = [
                        'no_racik' => $det->no_racik,
                        'kode_brng' => $det->kode_brng,
                        'nama_brng' => $det->dataBarang->nama_brng ?? $det->kode_brng,
                        'satuan' => $det->dataBarang->kodeSatuan->satuan ?? ($det->dataBarang->kode_sat ?? ''),
                        'p1' => (float)($det->p1 ?? 1),
                        'p2' => (float)($det->p2 ?? 1),
                        'kandungan' => (float)($det->kandungan ?? 0),
                        'jml' => (float)$det->jml,
                        'stok_depo' => (float)$stok,
                        'harga' => (float)$harga,
                        'biaya_obat' => $biayaObat,
                        'embalase' => $embalasePerObat,
                        'tuslah' => $tuslahPerObat,
                        'subtotal' => $subtotal,
                    ];
                }

                $racikans[] = [
                    'no_racik' => $rr->no_racik,
                    'nama_racik' => $rr->nama_racik,
                    'kd_racik' => $rr->kd_racik,
                    'nm_racik' => $rr->metode->nm_racik ?? 'Racikan',
                    'jml_dr' => (int)$rr->jml_dr,
                    'aturan_pakai' => $rr->aturan_pakai ?? '',
                    'keterangan' => $rr->keterangan ?? '-',
                    'total_biaya' => $totalBiayaRacik,
                    'details' => $detailItems,
                ];
            }
        }

        // Ambil daftar metode racik untuk dropdown modal
        $metodeRacik = DB::table('metode_racik')->select('kd_racik', 'nm_racik')->get();

        // Ambil soap plan / RTL
        $soapPlan = DB::table('pemeriksaan_ralan')
            ->where('no_rawat', $resep->no_rawat)
            ->where('rtl', '<>', '-')
            ->whereNotNull('rtl')
            ->value('rtl') ?? '';

        return response()->json([
            'resep' => $resep,
            'kdBangsal' => $kdBangsal,
            'nmBangsal' => $nmBangsal,
            'items' => $items,
            'racikans' => $racikans,
            'metode_racik' => $metodeRacik,
            'embalase_per_obat' => $embalasePerObat,
            'tuslah_per_obat' => $tuslahPerObat,
            'soap_plan' => $soapPlan,
            'is_validated' => $resep->tgl_perawatan !== '0000-00-00',
        ]);
    }

    public function tambahObatRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.1',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep) {
            return response()->json(['message' => 'Resep tidak ditemukan'], 404);
        }
        if ($resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi, tidak dapat menambah item obat'], 422);
        }

        $exist = ResepDokter::where('no_resep', $request->no_resep)
            ->where('kode_brng', $request->kode_brng)
            ->first();

        if ($exist) {
            $exist->jml += $request->jml;
            if ($request->aturan_pakai) {
                $exist->aturan_pakai = $request->aturan_pakai;
            }
            $exist->save();
        } else {
            ResepDokter::create([
                'no_resep' => $request->no_resep,
                'kode_brng' => $request->kode_brng,
                'jml' => $request->jml,
                'aturan_pakai' => $request->aturan_pakai ?? '',
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Obat berhasil ditambahkan ke resep']);
    }

    public function ubahObatRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.1',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi, tidak dapat mengubah item'], 422);
        }

        $kodeLama = $request->kode_brng;
        $kodeBaru = $request->kode_brng_baru ?: $kodeLama;

        if ($kodeBaru !== $kodeLama) {
            $exist = ResepDokter::where('no_resep', $request->no_resep)
                ->where('kode_brng', $kodeBaru)
                ->first();

            if ($exist) {
                $exist->jml += $request->jml;
                if ($request->aturan_pakai) {
                    $exist->aturan_pakai = $request->aturan_pakai;
                }
                $exist->save();

                ResepDokter::where('no_resep', $request->no_resep)
                    ->where('kode_brng', $kodeLama)
                    ->delete();
            } else {
                ResepDokter::where('no_resep', $request->no_resep)
                    ->where('kode_brng', $kodeLama)
                    ->update([
                        'kode_brng' => $kodeBaru,
                        'jml' => $request->jml,
                        'aturan_pakai' => $request->aturan_pakai ?? '',
                    ]);
            }
        } else {
            ResepDokter::where('no_resep', $request->no_resep)
                ->where('kode_brng', $kodeLama)
                ->update([
                    'jml' => $request->jml,
                    'aturan_pakai' => $request->aturan_pakai ?? '',
                ]);
        }

        return response()->json(['status' => true, 'message' => 'Item resep berhasil diperbarui']);
    }

    public function hapusObatRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'kode_brng' => 'required',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi, tidak dapat menghapus item'], 422);
        }

        ResepDokter::where('no_resep', $request->no_resep)
            ->where('kode_brng', $request->kode_brng)
            ->delete();

        return response()->json(['status' => true, 'message' => 'Item resep berhasil dihapus']);
    }

    // --- MANAJEMEN RESEP RACIKAN RALAN ---

    public function tambahRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'nama_racik' => 'required|string',
            'kd_racik' => 'required|string',
            'jml_dr' => 'required|numeric|min:1',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        $lastNo = ResepDokterRacikan::where('no_resep', $request->no_resep)->max('no_racik') ?? 0;
        $noRacik = $lastNo + 1;

        ResepDokterRacikan::create([
            'no_resep' => $request->no_resep,
            'no_racik' => $noRacik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai ?? '',
            'keterangan' => $request->keterangan ?? '-',
        ]);

        return response()->json(['status' => true, 'message' => 'Racikan baru berhasil ditambahkan', 'no_racik' => $noRacik]);
    }

    public function ubahRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'no_racik' => 'required',
            'nama_racik' => 'required|string',
            'kd_racik' => 'required|string',
            'jml_dr' => 'required|numeric|min:1',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        ResepDokterRacikan::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->update([
                'nama_racik' => $request->nama_racik,
                'kd_racik' => $request->kd_racik,
                'jml_dr' => $request->jml_dr,
                'aturan_pakai' => $request->aturan_pakai ?? '',
                'keterangan' => $request->keterangan ?? '-',
            ]);

        return response()->json(['status' => true, 'message' => 'Informasi racikan berhasil diperbarui']);
    }

    public function hapusRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'no_racik' => 'required',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->delete();

        ResepDokterRacikan::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->delete();

        return response()->json(['status' => true, 'message' => 'Racikan dan seluruh detailnya berhasil dihapus']);
    }

    public function tambahItemRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'no_racik' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.01',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        $exist = ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->where('kode_brng', $request->kode_brng)
            ->first();

        if ($exist) {
            $exist->jml += $request->jml;
            if ($request->filled('kandungan')) {
                $exist->kandungan = $request->kandungan;
            }
            $exist->save();
        } else {
            ResepDokterRacikanDetail::create([
                'no_resep' => $request->no_resep,
                'no_racik' => $request->no_racik,
                'kode_brng' => $request->kode_brng,
                'p1' => $request->p1 ?: 1,
                'p2' => $request->p2 ?: 1,
                'kandungan' => $request->kandungan ?: 0,
                'jml' => $request->jml,
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Item obat berhasil ditambahkan ke racikan']);
    }

    public function ubahItemRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'no_racik' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.01',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        $kodeLama = $request->kode_brng;
        $kodeBaru = $request->kode_brng_baru ?: $kodeLama;

        if ($kodeBaru !== $kodeLama) {
            $exist = ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
                ->where('no_racik', $request->no_racik)
                ->where('kode_brng', $kodeBaru)
                ->first();

            if ($exist) {
                $exist->jml += $request->jml;
                if ($request->filled('kandungan')) {
                    $exist->kandungan = $request->kandungan;
                }
                $exist->save();

                ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
                    ->where('no_racik', $request->no_racik)
                    ->where('kode_brng', $kodeLama)
                    ->delete();
            } else {
                ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
                    ->where('no_racik', $request->no_racik)
                    ->where('kode_brng', $kodeLama)
                    ->update([
                        'kode_brng' => $kodeBaru,
                        'jml' => $request->jml,
                        'kandungan' => $request->kandungan ?: 0,
                        'p1' => $request->p1 ?: 1,
                        'p2' => $request->p2 ?: 1,
                    ]);
            }
        } else {
            ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
                ->where('no_racik', $request->no_racik)
                ->where('kode_brng', $kodeLama)
                ->update([
                    'jml' => $request->jml,
                    'kandungan' => $request->kandungan ?: 0,
                    'p1' => $request->p1 ?: 1,
                    'p2' => $request->p2 ?: 1,
                ]);
        }

        return response()->json(['status' => true, 'message' => 'Item obat racikan berhasil diperbarui']);
    }

    public function hapusItemRacikanRalan(Request $request)
    {
        $request->validate([
            'no_resep' => 'required',
            'no_racik' => 'required',
            'kode_brng' => 'required',
        ]);

        $resep = $this->resepObat->where('no_resep', $request->no_resep)->first();
        if (!$resep || $resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep sudah tervalidasi atau tidak ditemukan'], 422);
        }

        ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->where('kode_brng', $request->kode_brng)
            ->delete();

        return response()->json(['status' => true, 'message' => 'Item obat berhasil dihapus dari racikan']);
    }

    public function validasiRalan(Request $request)
    {
        $request->validate(['no_resep' => 'required']);
        $noResep = $request->no_resep;

        $resep = $this->resepObat->where('no_resep', $noResep)->with('regPeriksa.pasien')->first();
        if (!$resep) {
            return response()->json(['message' => 'Resep tidak ditemukan'], 404);
        }

        if ($resep->tgl_perawatan !== '0000-00-00') {
            return response()->json(['message' => 'Resep ini sudah divalidasi sebelumnya'], 422);
        }

        $items = ResepDokter::where('no_resep', $noResep)->with('dataBarang')->get();
        $racikans = ResepDokterRacikan::where('no_resep', $noResep)->get();

        if ($items->isEmpty() && $racikans->isEmpty()) {
            return response()->json(['message' => 'Resep belum memiliki item obat. Silahkan tambahkan obat terlebih dahulu (sesuai Resep By Plan).'], 422);
        }

        $noRawat = $resep->no_rawat;
        $isRanap = ($resep->status === 'ranap');

        if ($isRanap) {
            $statusLanjut = 'Ranap';
            $kdBangsal = 'RM';
        } else {
            $statusLanjut = 'Ralan';
            $kdPoli = $resep->regPeriksa->kd_poli ?? '';
            $depoPoli = DB::table('set_depo_ralan')->where('kd_poli', $kdPoli)->first();
            $kdBangsal = $depoPoli->kd_bangsal ?? 'RM7';
        }

        $tglValidasi = date('Y-m-d');
        $jamValidasi = date('H:i:s');
        $nikPetugas = session()->get('pegawai')->nik ?? 'apotek';
        $ketMutasi = $noRawat;
        $setEmbalase = DB::table('set_embalase')->first();
        $embalasePerObat = (float)($setEmbalase->embalase_per_obat ?? 0);
        $tuslahPerObat = (float)($setEmbalase->tuslah_per_obat ?? 0);

        DB::beginTransaction();
        try {
            // 1. Proses Item Non-Racikan
            foreach ($items as $item) {
                $barang = $item->dataBarang;
                $hBeli = $barang->h_beli ?? 0;
                $biayaObat = ($barang->ralan ?? 0) > 0 ? $barang->ralan : $hBeli;
                $total = round(($biayaObat * $item->jml) + $embalasePerObat + $tuslahPerObat);

                DetailPemberianObat::create([
                    'tgl_perawatan' => $tglValidasi,
                    'jam' => $jamValidasi,
                    'no_rawat' => $noRawat,
                    'kode_brng' => $item->kode_brng,
                    'h_beli' => $hBeli,
                    'biaya_obat' => $biayaObat,
                    'jml' => $item->jml,
                    'embalase' => $embalasePerObat,
                    'tuslah' => $tuslahPerObat,
                    'total' => $total,
                    'status' => $statusLanjut,
                    'kd_bangsal' => $kdBangsal,
                    'no_batch' => '',
                    'no_faktur' => '',
                ]);

                if (!empty($item->aturan_pakai)) {
                    DB::table('aturan_pakai')->updateOrInsert(
                        [
                            'tgl_perawatan' => $tglValidasi,
                            'jam' => $jamValidasi,
                            'no_rawat' => $noRawat,
                            'kode_brng' => $item->kode_brng,
                        ],
                        ['aturan' => $item->aturan_pakai]
                    );
                }

                $gudang = GudangBarang::where('kode_brng', $item->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->first();

                $stokAwal = $gudang ? $gudang->stok : 0;
                $stokAkhir = $stokAwal - $item->jml;

                if ($gudang) {
                    DB::table('gudangbarang')
                        ->where('kode_brng', $gudang->kode_brng)
                        ->where('kd_bangsal', $gudang->kd_bangsal)
                        ->where('no_batch', $gudang->no_batch)
                        ->where('no_faktur', $gudang->no_faktur)
                        ->decrement('stok', $item->jml);
                } else {
                    DB::table('gudangbarang')->insert([
                        'kode_brng' => $item->kode_brng,
                        'kd_bangsal' => $kdBangsal,
                        'stok' => -$item->jml,
                        'no_batch' => '',
                        'no_faktur' => '',
                    ]);
                }

                DB::table('riwayat_barang_medis')->insert([
                    'kode_brng' => $item->kode_brng,
                    'stok_awal' => $stokAwal,
                    'masuk' => 0,
                    'keluar' => $item->jml,
                    'stok_akhir' => $stokAkhir,
                    'posisi' => 'Pemberian Obat',
                    'tanggal' => $tglValidasi,
                    'jam' => $jamValidasi,
                    'petugas' => $nikPetugas,
                    'kd_bangsal' => $kdBangsal,
                    'status' => 'Simpan',
                    'no_batch' => '',
                    'no_faktur' => '',
                    'keterangan' => $ketMutasi,
                ]);
            }

            // 2. Proses Item Racikan (jika ada)
            foreach ($racikans as $racik) {
                DB::table('obat_racikan')->insert([
                    'tgl_perawatan' => $tglValidasi,
                    'jam' => $jamValidasi,
                    'no_rawat' => $noRawat,
                    'no_racik' => $racik->no_racik,
                    'nama_racik' => $racik->nama_racik,
                    'kd_racik' => $racik->kd_racik,
                    'jml_dr' => $racik->jml_dr,
                    'aturan_pakai' => $racik->aturan_pakai,
                    'keterangan' => $racik->keterangan ?? '-',
                ]);

                $details = ResepDokterRacikanDetail::where('no_resep', $noResep)
                    ->where('no_racik', $racik->no_racik)
                    ->with('dataBarang')
                    ->get();

                foreach ($details as $det) {
                    $brng = $det->dataBarang;
                    $hBeli = $brng->h_beli ?? 0;
                    $biayaObat = ($brng->ralan ?? 0) > 0 ? $brng->ralan : $hBeli;
                    $total = round(($biayaObat * $det->jml) + $embalasePerObat + $tuslahPerObat);

                    DB::table('detail_obat_racikan')->insert([
                        'tgl_perawatan' => $tglValidasi,
                        'jam' => $jamValidasi,
                        'no_rawat' => $noRawat,
                        'no_racik' => $racik->no_racik,
                        'kode_brng' => $det->kode_brng,
                    ]);

                    DetailPemberianObat::create([
                        'tgl_perawatan' => $tglValidasi,
                        'jam' => $jamValidasi,
                        'no_rawat' => $noRawat,
                        'kode_brng' => $det->kode_brng,
                        'h_beli' => $hBeli,
                        'biaya_obat' => $biayaObat,
                        'jml' => $det->jml,
                        'embalase' => $embalasePerObat,
                        'tuslah' => $tuslahPerObat,
                        'total' => $total,
                        'status' => $statusLanjut,
                        'kd_bangsal' => $kdBangsal,
                        'no_batch' => '',
                        'no_faktur' => '',
                    ]);

                    $gudang = GudangBarang::where('kode_brng', $det->kode_brng)
                        ->where('kd_bangsal', $kdBangsal)
                        ->first();

                    $stokAwal = $gudang ? $gudang->stok : 0;
                    $stokAkhir = $stokAwal - $det->jml;

                    if ($gudang) {
                        DB::table('gudangbarang')
                            ->where('kode_brng', $gudang->kode_brng)
                            ->where('kd_bangsal', $gudang->kd_bangsal)
                            ->where('no_batch', $gudang->no_batch)
                            ->where('no_faktur', $gudang->no_faktur)
                            ->decrement('stok', $det->jml);
                    } else {
                        DB::table('gudangbarang')->insert([
                            'kode_brng' => $det->kode_brng,
                            'kd_bangsal' => $kdBangsal,
                            'stok' => -$det->jml,
                            'no_batch' => '',
                            'no_faktur' => '',
                        ]);
                    }

                    DB::table('riwayat_barang_medis')->insert([
                        'kode_brng' => $det->kode_brng,
                        'stok_awal' => $stokAwal,
                        'masuk' => 0,
                        'keluar' => $det->jml,
                        'stok_akhir' => $stokAkhir,
                        'posisi' => 'Pemberian Obat',
                        'tanggal' => $tglValidasi,
                        'jam' => $jamValidasi,
                        'petugas' => $nikPetugas,
                        'kd_bangsal' => $kdBangsal,
                        'status' => 'Simpan',
                        'no_batch' => '',
                        'no_faktur' => '',
                        'keterangan' => $ketMutasi,
                    ]);
                }
            }

            // 3. Update resep_obat dengan waktu validasi
            DB::table('resep_obat')
                ->where('no_resep', $noResep)
                ->update([
                    'tgl_perawatan' => $tglValidasi,
                    'jam' => $jamValidasi,
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Resep rawat jalan berhasil divalidasi! Obat telah diproses ke billing dan stok telah dikurangi.',
                'tgl_perawatan' => $tglValidasi,
                'jam' => $jamValidasi,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memvalidasi resep: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getEtiketItems($no_resep)
    {
        $resep = $this->resepObat->where('no_resep', $no_resep)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.poliklinik',
                'regPeriksa.dokter',
                'dokter',
                'resepDokter.dataBarang.kodeSatuan',
                'resepRacikan.metode',
            ])->first();

        if (!$resep) {
            return response()->json(['message' => 'Resep tidak ditemukan'], 404);
        }

        $itemsUmum = [];
        if ($resep->resepDokter && count($resep->resepDokter) > 0) {
            foreach ($resep->resepDokter as $rd) {
                $itemsUmum[] = [
                    'kode' => $rd->kode_brng,
                    'nama' => $rd->dataBarang->nama_brng ?? $rd->kode_brng,
                    'satuan' => $rd->dataBarang->kodeSatuan->satuan ?? ($rd->dataBarang->kode_sat ?? 'TAB'),
                    'jml' => (float)$rd->jml,
                    'aturan_pakai' => $rd->aturan_pakai ?? '',
                ];
            }
        } else {
            // Fallback ke detail_pemberian_obat & aturan_pakai jika resep sudah divalidasi
            $pemberian = DB::table('detail_pemberian_obat')
                ->join('databarang', 'detail_pemberian_obat.kode_brng', '=', 'databarang.kode_brng')
                ->leftJoin('kodesatuan', 'databarang.kode_sat', '=', 'kodesatuan.kode_sat')
                ->leftJoin('aturan_pakai', function ($join) use ($resep) {
                    $join->on('detail_pemberian_obat.kode_brng', '=', 'aturan_pakai.kode_brng')
                        ->where('aturan_pakai.no_rawat', '=', $resep->no_rawat)
                        ->where('aturan_pakai.tgl_perawatan', '=', $resep->tgl_perawatan)
                        ->where('aturan_pakai.jam', '=', $resep->jam);
                })
                ->where('detail_pemberian_obat.no_rawat', $resep->no_rawat)
                ->where('detail_pemberian_obat.tgl_perawatan', $resep->tgl_perawatan)
                ->where('detail_pemberian_obat.jam', $resep->jam)
                ->whereNotIn('detail_pemberian_obat.kode_brng', function ($q) use ($resep) {
                    $q->select('kode_brng')->from('detail_obat_racikan')
                        ->where('no_rawat', $resep->no_rawat)
                        ->where('tgl_perawatan', $resep->tgl_perawatan)
                        ->where('jam', $resep->jam);
                })
                ->select(
                    'detail_pemberian_obat.kode_brng',
                    'databarang.nama_brng',
                    'kodesatuan.satuan',
                    'detail_pemberian_obat.jml',
                    'aturan_pakai.aturan as aturan_pakai'
                )->get();

            foreach ($pemberian as $pb) {
                $itemsUmum[] = [
                    'kode' => $pb->kode_brng,
                    'nama' => $pb->nama_brng,
                    'satuan' => $pb->satuan ?? 'TAB',
                    'jml' => (float)$pb->jml,
                    'aturan_pakai' => $pb->aturan_pakai ?? '',
                ];
            }
        }

        $itemsRacik = [];
        if ($resep->resepRacikan && count($resep->resepRacikan) > 0) {
            foreach ($resep->resepRacikan as $rr) {
                $itemsRacik[] = [
                    'kode' => $rr->no_racik,
                    'nama' => ($rr->metode->nm_racik ?? 'Racik') . ' ' . $rr->nama_racik,
                    'satuan' => $rr->metode->nm_racik ?? 'Bungkus',
                    'jml' => (float)$rr->jml_dr,
                    'aturan_pakai' => $rr->aturan_pakai ?? '',
                ];
            }
        } else {
            // Fallback ke obat_racikan jika resep sudah divalidasi
            $racikanVal = DB::table('obat_racikan')
                ->leftJoin('metode_racik', 'obat_racikan.kd_racik', '=', 'metode_racik.kd_racik')
                ->where('no_rawat', $resep->no_rawat)
                ->where('tgl_perawatan', $resep->tgl_perawatan)
                ->where('jam', $resep->jam)
                ->select(
                    'obat_racikan.no_racik',
                    'obat_racikan.nama_racik',
                    'obat_racikan.jml_dr',
                    'obat_racikan.aturan_pakai',
                    'metode_racik.nm_racik'
                )->get();

            foreach ($racikanVal as $rv) {
                $itemsRacik[] = [
                    'kode' => $rv->no_racik,
                    'nama' => ($rv->nm_racik ?? 'Racik') . ' ' . $rv->nama_racik,
                    'satuan' => $rv->nm_racik ?? 'Bungkus',
                    'jml' => (float)$rv->jml_dr,
                    'aturan_pakai' => $rv->aturan_pakai ?? '',
                ];
            }
        }

        return response()->json([
            'no_resep' => $resep->no_resep,
            'pasien' => $resep->regPeriksa->pasien ?? null,
            'dokter' => $resep->dokter->nm_dokter ?? ($resep->regPeriksa->dokter->nm_dokter ?? '-'),
            'poli' => $resep->regPeriksa->poliklinik->nm_poli ?? ($resep->status === 'ranap' ? 'Rawat Inap' : 'Rawat Jalan'),
            'items_umum' => $itemsUmum,
            'items_racik' => $itemsRacik,
        ]);
    }

    public function printEtiket(Request $request, $no_resep = null)
    {
        $no_resep = $no_resep ?: $request->no_resep;
        if (!$no_resep) {
            abort(404, 'Nomor Resep tidak ditemukan');
        }

        $ukuran = $request->ukuran ?: '6.5x4';
        $itemType = $request->item_type; // 'all', 'umum', 'racik'
        $itemKey = $request->item_key;

        $resep = $this->resepObat->where('no_resep', $no_resep)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.poliklinik',
                'regPeriksa.dokter',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'resepDokter.dataBarang.kodeSatuan',
                'resepDokter.dataBarang.jenis',
                'resepRacikan.metode',
                'telaahFarmasi',
            ])->first();

        if (!$resep) {
            abort(404, 'Data resep tidak ditemukan');
        }

        $setting = DB::table('setting')->first();
        $logoFile = public_path('img/LOGO RSIA .png');
        if (file_exists($logoFile)) {
            $logoBase64 = base64_encode(file_get_contents($logoFile));
        } else {
            $logoBase64 = ($setting && !empty($setting->logo)) ? base64_encode($setting->logo) : null;
        }

        $tglResep = (!empty($resep->tgl_peresepan) && $resep->tgl_peresepan !== '0000-00-00')
            ? date('d/m/Y', strtotime($resep->tgl_peresepan))
            : date('d/m/Y', strtotime($resep->tgl_perawatan ?: date('Y-m-d')));

        $jamResep = (!empty($resep->jam_peresepan) && $resep->jam_peresepan !== '00:00:00')
            ? substr($resep->jam_peresepan, 0, 8)
            : substr($resep->jam && $resep->jam !== '00:00:00' ? $resep->jam : date('H:i:s'), 0, 8);

        $kamarDisplay = '-';
        if ($resep->status === 'ranap' && $resep->regPeriksa && $resep->regPeriksa->kamarInap) {
            $currentKamar = is_iterable($resep->regPeriksa->kamarInap)
                ? ($resep->regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $resep->regPeriksa->kamarInap->first())
                : $resep->regPeriksa->kamarInap;
            if ($currentKamar && $currentKamar->kamar) {
                $bangsal = $currentKamar->kamar->bangsal->nm_bangsal ?? '';
                $kdKamar = $currentKamar->kd_kamar ?? '';
                $kamarDisplay = $bangsal ? "{$bangsal} ({$kdKamar})" : $kdKamar;
            }
        }

        $items = [];

        // 1. Obat Non-Racik (resep_dokter)
        if (!$itemType || $itemType === 'all' || $itemType === 'umum') {
            if ($resep->resepDokter && count($resep->resepDokter) > 0) {
                foreach ($resep->resepDokter as $rd) {
                    if ($itemKey && $itemType === 'umum' && $rd->kode_brng != $itemKey) {
                        continue;
                    }
                    $items[] = [
                        'tipe' => 'umum',
                        'kode' => $rd->kode_brng,
                        'nama' => $rd->dataBarang->nama_brng ?? $rd->kode_brng,
                        'satuan' => $rd->dataBarang->kodeSatuan->satuan ?? ($rd->dataBarang->kode_sat ?? 'TAB'),
                        'jml' => (float)$rd->jml,
                        'aturan_pakai' => $rd->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => $rd->dataBarang->jenis->nama ?? '',
                        'keterangan' => '',
                        'detail_racik' => [],
                    ];
                }
            } else {
                // Fallback jika sudah masuk detail_pemberian_obat & aturan_pakai
                $pemberian = DB::table('detail_pemberian_obat')
                    ->join('databarang', 'detail_pemberian_obat.kode_brng', '=', 'databarang.kode_brng')
                    ->leftJoin('kodesatuan', 'databarang.kode_sat', '=', 'kodesatuan.kode_sat')
                    ->leftJoin('jenis', 'databarang.kdjns', '=', 'jenis.kdjns')
                    ->leftJoin('aturan_pakai', function ($join) use ($resep) {
                        $join->on('detail_pemberian_obat.kode_brng', '=', 'aturan_pakai.kode_brng')
                            ->where('aturan_pakai.no_rawat', '=', $resep->no_rawat)
                            ->where('aturan_pakai.tgl_perawatan', '=', $resep->tgl_perawatan)
                            ->where('aturan_pakai.jam', '=', $resep->jam);
                    })
                    ->where('detail_pemberian_obat.no_rawat', $resep->no_rawat)
                    ->where('detail_pemberian_obat.tgl_perawatan', $resep->tgl_perawatan)
                    ->where('detail_pemberian_obat.jam', $resep->jam)
                    ->whereNotIn('detail_pemberian_obat.kode_brng', function ($q) use ($resep) {
                        $q->select('kode_brng')->from('detail_obat_racikan')
                            ->where('no_rawat', $resep->no_rawat)
                            ->where('tgl_perawatan', $resep->tgl_perawatan)
                            ->where('jam', $resep->jam);
                    })
                    ->select(
                        'detail_pemberian_obat.kode_brng',
                        'databarang.nama_brng',
                        'kodesatuan.satuan',
                        'jenis.nama as nama_jenis',
                        'detail_pemberian_obat.jml',
                        'aturan_pakai.aturan as aturan_pakai'
                    )->get();

                foreach ($pemberian as $pb) {
                    if ($itemKey && $itemType === 'umum' && $pb->kode_brng != $itemKey) {
                        continue;
                    }
                    $items[] = [
                        'tipe' => 'umum',
                        'kode' => $pb->kode_brng,
                        'nama' => $pb->nama_brng,
                        'satuan' => $pb->satuan ?? 'TAB',
                        'jml' => (float)$pb->jml,
                        'aturan_pakai' => $pb->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => $pb->nama_jenis ?? '',
                        'keterangan' => '',
                        'detail_racik' => [],
                    ];
                }
            }
        }

        // 2. Obat Racikan (resep_dokter_racikan)
        if (!$itemType || $itemType === 'all' || $itemType === 'racik') {
            if ($resep->resepRacikan && count($resep->resepRacikan) > 0) {
                foreach ($resep->resepRacikan as $rr) {
                    if ($itemKey && $itemType === 'racik' && $rr->no_racik != $itemKey) {
                        continue;
                    }

                    $detailList = [];
                    $details = ResepDokterRacikanDetail::where('no_resep', $no_resep)
                        ->where('no_racik', $rr->no_racik)
                        ->with('dataBarang')
                        ->get();

                    foreach ($details as $dtl) {
                        $nmObat = $dtl->dataBarang->nama_brng ?? $dtl->kode_brng;
                        $detailList[] = $nmObat;
                    }

                    $items[] = [
                        'tipe' => 'racik',
                        'kode' => $rr->no_racik,
                        'nama' => ($rr->metode->nm_racik ?? 'Racikan') . ' ' . $rr->nama_racik,
                        'satuan' => $rr->metode->nm_racik ?? 'Bungkus',
                        'jml' => (float)$rr->jml_dr,
                        'aturan_pakai' => $rr->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => '',
                        'keterangan' => $rr->keterangan ?: '',
                        'detail_racik' => $detailList,
                    ];
                }
            } else {
                // Fallback jika sudah masuk obat_racikan
                $racikans = DB::table('obat_racikan')
                    ->leftJoin('metode_racik', 'obat_racikan.kd_racik', '=', 'metode_racik.kd_racik')
                    ->where('no_rawat', $resep->no_rawat)
                    ->where('tgl_perawatan', $resep->tgl_perawatan)
                    ->where('jam', $resep->jam)
                    ->select(
                        'obat_racikan.no_racik',
                        'obat_racikan.nama_racik',
                        'obat_racikan.jml_dr',
                        'obat_racikan.aturan_pakai',
                        'obat_racikan.keterangan',
                        'metode_racik.nm_racik'
                    )->get();

                foreach ($racikans as $rv) {
                    if ($itemKey && $itemType === 'racik' && $rv->no_racik != $itemKey) {
                        continue;
                    }

                    $detailObat = DB::table('detail_obat_racikan')
                        ->join('databarang', 'detail_obat_racikan.kode_brng', '=', 'databarang.kode_brng')
                        ->where('detail_obat_racikan.no_rawat', $resep->no_rawat)
                        ->where('detail_obat_racikan.tgl_perawatan', $resep->tgl_perawatan)
                        ->where('detail_obat_racikan.jam', $resep->jam)
                        ->where('detail_obat_racikan.no_racik', $rv->no_racik)
                        ->pluck('databarang.nama_brng')
                        ->toArray();

                    $items[] = [
                        'tipe' => 'racik',
                        'kode' => $rv->no_racik,
                        'nama' => ($rv->nm_racik ?? 'Racikan') . ' ' . $rv->nama_racik,
                        'satuan' => $rv->nm_racik ?? 'Bungkus',
                        'jml' => (float)$rv->jml_dr,
                        'aturan_pakai' => $rv->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => '',
                        'keterangan' => $rv->keterangan ?: '',
                        'detail_racik' => $detailObat,
                    ];
                }
            }
        }

        if (empty($items)) {
            $items[] = [
                'tipe' => 'umum',
                'kode' => '-',
                'nama' => 'Tidak Ada Obat',
                'satuan' => '-',
                'jml' => 0,
                'aturan_pakai' => '-',
                'jenis' => '',
                'keterangan' => '',
                'detail_racik' => [],
            ];
        }

        // Ukuran stiker dalam satuan points (1 cm = 28.3465 pt)
        $dimensions = [
            '6.5x4' => [184.25, 113.39], // Default SIMRS Khanza Model 1 & 2 (184pt x 113pt)
            '8x5'   => [226.77, 141.73], // 8 x 5 cm
            '7x5'   => [198.43, 141.73], // 7 x 5 cm
            '8x6'   => [226.77, 170.08], // 8 x 6 cm
            '5x3'   => [141.73, 85.04],  // 5 x 3 cm
            '5x5.8' => [144.00, 165.00], // SIMRS Khanza Model 3 Portrait (144pt x 165pt)
        ];

        $paperSize = $dimensions[$ukuran] ?? $dimensions['6.5x4'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('content.print.etiket_obat', [
            'resep' => $resep,
            'items' => $items,
            'setting' => $setting,
            'ukuran' => $ukuran,
            'paperSize' => $paperSize,
            'logoBase64' => $logoBase64,
            'tglResep' => $tglResep,
            'jamResep' => $jamResep,
            'kamarDisplay' => $kamarDisplay,
        ])
        ->setPaper([0, 0, $paperSize[0], $paperSize[1]])
        ->setOptions([
            'defaultFont' => 'Helvetica',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream("etiket-{$no_resep}-{$ukuran}.pdf");
    }
}
