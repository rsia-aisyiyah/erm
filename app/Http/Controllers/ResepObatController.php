<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;
use App\Models\ResepObat;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast;
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
        $jam = $request->jam == 'true' ? date('H:i:s') : '00:00:00';
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
        $resepObat = $this->resepObat->where('tgl_peresepan', date('Y-m-d'))->where('status', 'ralan')->with('regPeriksa')->get();
        return response()->json($resepObat);
    }
    public function ambilTable(Request $request)
    {
        $resepObat = $this->resepObat
            ->where('tgl_peresepan', date('Y-m-d', strtotime($request->tgl_peresepan)))
            ->orWhere('tgl_penyerahan', date('Y-m-d', strtotime($request->tgl_penyerahan)))
            ->with('regPeriksa.pasien', 'regPeriksa.poliklinik', 'regPeriksa.dokter.spesialis')->where('status', 'ralan')
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
}
