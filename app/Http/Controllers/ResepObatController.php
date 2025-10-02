<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;
use App\Models\ResepObat;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ResepObatController extends Controller
{
    private $resepObat;
    private $track;

    use ResponseTrait;
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
        $resepObat = $this->resepObat->where('no_resep', $no_resep)->where('status', 'ralan')
            ->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')
            ->first();
        return response()->json($resepObat);
    }
    public function ambil(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->no_rawat) {
            $resepObat = $this->resepObat->where('no_rawat', $request->no_rawat)->where('status', 'ralan')->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->get();
        }
        if ($request->no_resep) {
            $resepObat = $this->resepObat->where('no_resep', $request->no_resep)->where('status', 'ralan')->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->first();
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
            'no_resep' => $request->no_resep ? $request->no_resep : $this->createNoResep(),
            'kd_dokter' => $request->kd_dokter,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => '0000-00-00',
            'jam' => date('H:i:s', strtotime("00:00:00")),
            'tgl_peresepan' => date('Y-m-d'),
            'jam_peresepan' => date('H:i:s'),
            'status' => 'ralan',
            'tgl_penyerahan' => '0000-00-00',
            'jam_penyerahan' => date('H:i:s', strtotime("00:00:00")),
        ];
        try {
            $create = $this->resepObat->create($data);
            if ($create) {
                $this->track->insertSql($this->resepObat, $data);

            }
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
                'no_resep' => $create->no_resep,
                'jam_peresepan' => $create->jam_peresepan,
                'tgl_peresepan' => $create->tgl_peresepan
            ]);

        } catch (QueryException $e) {
            return $this->errorResponse($e, $e->getMessage(), 500);
        }
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
        })->with(['resepRacikan.detailRacikan.databarang.kodeSatuan', 'resepRacikan.metode', 'resepDokter.dataBarang.kodeSatuan'])->get();

        return response()->json($resep);
    }

    function createNoResep()
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

    function copyResep($no_resep, Request $request)
    {


        $noResepExist = null;
        try {
            $resep = $this->isAvailable($request->no_rawat);
            if ($resep) {
                $noResepExist = $resep->no_resep;
            }
        } catch (Exception $e) {

            return $this->errorResponse($e, $e->getMessage(), 500);
        }
        $get = $this->get($no_resep);
        $no = $noResepExist ? $noResepExist : $this->createNoResep();
        $data = json_decode($get->content());

        $requestCreeateResep = new Request([
            'no_resep' => $no,
            'kd_dokter' => $request->kd_dokter,
            'no_rawat' => $request->no_rawat,
        ]);

        $resepDokter = collect($data->resep_dokter)->map((function ($item) use ($no) {
            return [
                'kode_brng' => $item->kode_brng,
                'jml' => $item->jml,
                'aturan_pakai' => $item->aturan_pakai,
                'no_resep' => $no,
            ];
        }));

        $resepRacikan = collect($data->resep_racikan)->map((function ($item, $key) use ($no) {
            return [
                'kd_racik' => $item->kd_racik,
                'nama_racik' => $item->nama_racik,
                'jml_dr' => $item->jml_dr,
                'aturan_pakai' => $item->aturan_pakai,
                'no_racik' => $key + 1,
                'keterangan' => $item->keterangan,
                'no_resep' => $no,
                'detail' => collect($item->detail_racikan)->map((function ($detail) use ($no) {
                    return [
                        'no_resep' => $no,
                        'no_racik' => $detail->no_racik,
                        'kode_brng' => $detail->kode_brng,
                        'jml' => $detail->jml,
                        'p1' => $detail->p1,
                        'p2' => $detail->p2,
                        'kandungan' => $detail->kandungan,

                    ];
                }))
            ];
        }));


        try {
            DB::transaction(function () use ($resepDokter, $resepRacikan, $requestCreeateResep) {
                $this->create($requestCreeateResep);

                if ($resepDokter->isEmpty()) {
                    throw new \Exception("Resep dokter tidak boleh kosong!");
                }

                ResepDokter::insert($resepDokter->toArray());

                $racikan = $resepRacikan
                    ->map(fn($item) => collect($item)->except('detail'))
                    ->toArray();
                ResepDokterRacikan::insert($racikan);

                $detailRacikan = $resepRacikan->pluck('detail')->collapse();
                ResepDokterRacikanDetail::insert($detailRacikan->toArray());
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Resep berhasil disimpan'
            ], 200);

        } catch (\Throwable $e) {

            return $this->errorResponse($e, $e->getMessage(), 500);
        }
    }
}
