<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepDokterRacikan;
use App\Http\Controllers\Controller;
use App\Models\ResepDokterRacikanDetail;
use App\Http\Controllers\TrackerSqlController;
use App\Http\Controllers\ResepDokterRacikanDetailController;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\QueryException;

class ResepDokterRacikanController extends Controller
{
    use JsonResponseTrait;
    protected $track;
    protected $resep;
    protected $resepDetail;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->resep = new ResepDokterRacikan();
        $this->resepDetail = new ResepDokterRacikanDetailController();
    }
    public function ambil(Request $request)
    {
        $resepDokter = new ResepDokterRacikan();
        $hasil = '';
        if ($request->no_resep) {
            if ($request->no_racik) {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)
                    ->with(['metode', 'detail' => function ($q) use ($request) {
                        $q->with(['databarang' => function ($query) {
                            return $query->with('kodeSatuan')->select(['kode_brng', 'nama_brng', 'kapasitas', 'kode_sat']);
                        }])->where('no_racik', $request->no_racik);
                    }])->first();
            } else {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->with(['metode', 'detail' => function ($query) {
                    return $query->with(['databarang' => function ($query) {
                        return $query->with('kodeSatuan')->select(['kode_brng', 'nama_brng', 'kapasitas', 'kode_sat']);
                    }]);
                }])->get();
            }
        }
        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => '-',
        ];

        try {
            $resep = ResepDokterRacikan::create($data);
            $this->track->insertSql($this->resep, $data);
        } catch (QueryException $e) {
            return $this->errorResponse('Error', 400, $e->errorInfo);
        }
        return response()->json($resep);
    }

    public function hapus(Request $request)
    {
        $clause = [
            'no_racik' => $request->no_racik,
            'no_resep' => $request->no_resep
        ];
        try {
            $resepDetail = $this->resepDetail->hapus($request);
            $resep = ResepDokterRacikan::where($clause)->delete();
            $this->track->deleteSql($this->resep, $clause);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json($resep);
    }
    public function ubah(Request $request)
    {
        $clause = [
            'no_racik' => $request->no_racik,
            'no_resep' => $request->no_resep,
        ];
        $data = [
            'nama_racik' => $request->nama_racik,
            'aturan_pakai' => $request->aturan_pakai,
            'kd_racik' => $request->metode ? $request->metode : $request->kd_racik,
        ];

        try {
            $resep = ResepDokterRacikan::where($clause)->update($data);
        } catch (QueryException $e) {
            return $this->errorResponse('Error', 400, $e->errorInfo);
        }

        $this->track->updateSql($this->resep, $data, $clause);
        return response()->json($request);
    }

    function createCopy(Request $request)
    {
        $count = count($request->data);

        try {
            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'no_resep' => $request->data[$i]['no_resep'],
                    'no_racik' => $request->data[$i]['no_racik'],
                    'nama_racik' => $request->data[$i]['nama_racik'],
                    'kd_racik' => $request->data[$i]['kd_racik'],
                    'jml_dr' => $request->data[$i]['jml_dr'],
                    'aturan_pakai' => $request->data[$i]['aturan_pakai'],
                    'keterangan' => '-',
                ];

                $resep = ResepDokterRacikan::create($data);
                if ($resep) {
                    $detail = new ResepDokterRacikanDetailController();
                    $detailObat = $request->data[$i]['detail'];
                    if (count($detailObat) > 1) {
                        $detail->createBatch(new \Illuminate\Http\Request(['dataObat' => $request->data[$i]['detail']]));
                    }
                    $this->track->insertSql(new ResepDokterRacikan(), $data);
                }
            }
        } catch (QueryException $e) {
            return $this->errorResponse('Error', 400, $e->errorInfo);
        }
        return $this->successResponse();
    }

    function create(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => '-',
        ];

        try {
            $resep = ResepDokterRacikan::create($data);
            $this->track->insertSql($this->resep, $data);
        } catch (QueryException $e) {
            return $this->errorResponse('Error', 400, $e->errorInfo);
        }
        return $this->successResponse($data);
    }

    function update(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => '-',
        ];

        try {
            $resep = ResepDokterRacikan::where([
                'no_resep' => $request->no_resep,
                'no_racik' => $request->no_racik,
            ])->update($data);
            $this->track->updateSql(new ResepDokterRacikan, $data, [
                'no_resep' => $request->no_resep,
                'no_racik' => $request->no_racik,
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Error', 400, $e->errorInfo);
        }
        return $this->successResponse($data);
    }
}
