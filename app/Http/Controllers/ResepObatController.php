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
            ->with('regPeriksa.pasien', 'regPeriksa.poliklinik', 'regPeriksa.dokter.spesialis')
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
}
