<?php

namespace App\Http\Controllers;

use App\Models\PermintaanRadiologi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PermintaanRadiologiController extends Controller
{
    protected $track;
    protected $radiologi;

    public function __construct()
    {
        $this->radiologi = new PermintaanRadiologi();
        $this->track = new TrackerSqlController();
    }

    function view()
    {
        return view('content.radiologi.radiologi');
    }
    function index()
    {
        $radiologi = $this->radiologi->where([
            'tgl_permintaan' => date('Y-m-d'),
            'tgl_hasil' => date('Y-m-d')
        ])->with(['regPeriksa' => function ($q) {
                    return $q->select([
                        'no_rawat',
                        'tgl_registrasi',
                        'stts',
                        'kd_poli',
                        'kd_dokter',
                        'kd_pj',
                        DB::raw('TRIM(no_rkm_medis) as no_rkm_medis')
                    ])->with([
                                'pasien' => function ($q) {
                                    return $q->select([
                                        DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
                                        'nm_pasien',
                                        'umurdaftar',
                                        'sttsumur'
                                    ]);
            }]);
        }, 'dokterRujuk', 'periksaRadiologi.jnsPerawatan', 'hasilRadiologi', 'regPeriksa.pasien'])->get();

        return $radiologi;
    }
    public function getByNoRawat(Request $request)
    {

        $radiologi = $this->radiologi
            ->with([
                'regPeriksa' => function ($q) {
                    return $q->select([
                        'no_rawat',
                        'tgl_registrasi',
                        'stts',
                        'kd_poli',
                        'kd_dokter',
                        'kd_pj',
                        'umurdaftar',
                        'sttsumur',
                        DB::raw('TRIM(no_rkm_medis) as no_rkm_medis')
                    ])->with([
                                'pasien' => function ($q) {
                                    return $q->select([
                                        DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
                                        'nm_pasien',
                                        'tgl_lahir',
                                    ]);
            }]);
        }, 'dokterRujuk', 'periksaRadiologi.jnsPerawatan', 'hasilRadiologi', 'gambarRadiologi', 'permintaanPemeriksaan.jnsPemeriksaan']);

        if ($request->tgl_permintaan && $request->jam_permintaan) {
            $radiologi = $radiologi->where([
                'no_rawat', $request->no_rawat,
                'tgl_permintaan', $request->tgl_permintaan,
                'jam_permintaan', $request->jam_permintaan,
            ])->first();
        } else {
            $radiologi = $radiologi->where('no_rawat', $request->no_rawat)->get();
        }
        return $radiologi;
    }
    function getParameter(Request $request)
    {
        $radiologi = $this->radiologi;
        if ($request->tgl_awal) {
            $radiologi = $radiologi->whereBetween('tgl_hasil', [$request->tgl_awal, $request->tgl_akhir]);
        }
        if ($request->spesialis) {
            $radiologi = $radiologi->whereHas('dokterRujuk.spesialis', function ($query) use ($request) {
                $query->where('kd_sps', $request->spesialis);
            });
        }
        if ($request->status) {
            $radiologi = $radiologi->where('status', $request->status);
        }
        return $radiologi->with(['regPeriksa.pasien', 'dokterRujuk', 'periksaRadiologi.jnsPerawatan', 'hasilRadiologi', 'permintaanPemeriksaan.jnsPemeriksaan'])->get();
    }
    function getTableIndex(Request $request)
    {
        // return;
        if ($request->tgl_awal || $request->spesialis || $request->status) {
            $permintaanRadiologi = $this->getParameter($request);
        } else {
            $permintaanRadiologi = $this->index();
        }
        return DataTables::of($permintaanRadiologi)->make(true);
    }
    public function updateDateTime($clause = [], $data = [])
    {
        $update = $this->radiologi->where($clause)->update($data);
        if ($update) {
            $this->track->updateSql($this->radiologi, $data, $clause);
        }
    }
    function getNomor(): string
    {
        $permintaan = $this->radiologi
            ->where('tgl_permintaan', date('Y-m-d'))
            ->select('noorder')->orderBy('noorder', 'desc')->first();
        if ($permintaan == null) {
            $now = date('Ymd');
            $nomor = "PR{$now}0001";
        } else {
            $arrString = explode('PR', $permintaan->noorder);
            $nomor =  (int)$arrString[1] + 1;
            $nomor = "PR{$nomor}";
        }
        return $nomor;
    }

    function create(Request $request)
    {
        $data = [
            'noorder' => $request->noorder,
            'no_rawat' => $request->no_rawat,
            'tgl_permintaan' => date('Y-m-d'),
            'jam_permintaan' => date('H:i:s'),
            'dokter_perujuk' => $request->kd_dokter,
            'status' => $request->status,
            'informasi_tambahan' => $request->informasi_tambahan,
            'diagnosa_klinis' => $request->diagnosa_klinis,
            'tgl_sampel' => "0000-00-00",
            'jam_sampel' => "00:00:00",
            'tgl_hasil' => "0000-00-00",
            'jam_hasil' => "00:00:00",
        ];

        try {
            $create = $this->radiologi->create($data);
            if ($create) {
                $this->track->insertSql($this->radiologi, $data);
            }
            return response()->json('SUKSES');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
}
