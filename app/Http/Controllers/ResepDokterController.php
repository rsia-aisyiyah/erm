<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Traits\JsonResponseTrait;
use Facade\Ignition\QueryRecorder\QueryRecorder;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResepDokterController extends Controller
{
    use JsonResponseTrait;
    private $resepDokter;
    private $track;
    public function __construct()
    {
        $this->resepDokter = new ResepDokter();
        $this->track = new TrackerSqlController();
    }

    public function cari(Request $request)
    {
        $resepDokter = $this->resepDokter;
        $hasil = '';
        if ($request->aturan_pakai) {
            $hasil = $resepDokter->where('aturan_pakai', 'like', '%' . $request->aturan_pakai . "%")->limit(10)->groupBy('aturan_pakai')->get();
        } else {
            $hasil =  $resepDokter->limit(10)->get();
        }

        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng,
            'jml' => $request->jml,
            'aturan_pakai' => $request->aturan_pakai,
        ];
        $resepDokter = $this->resepDokter->create($data);
        $this->track->insertSql($this->resepDokter, $data);
        return response()->json($resepDokter);
    }
    public function hapus(Request $request)
    {
        $data =  [
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng,
        ];
        $resepDokter = $this->resepDokter->where($data)->delete();
        $this->track->deleteSql($this->resepDokter, $data);
        return response()->json($resepDokter, 200);
    }

    public function ubah(Request $request)
    {
        $data = [
            'jml' => $request->jml,
            'aturan_pakai' => $request->aturan_pakai,
        ];
        $clause = [
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng
        ];

        $resepDokter = $this->resepDokter->where($clause)->update($data);
        $this->track->updateSql($this->resepDokter, $data, $clause);
        return response()->json('Data berhasil diubah');
    }

    function create(Request $request)
    {
        $countArray = count($request->dataObat);

        try {
            for ($i = 0; $i < $countArray; $i++) {
                $resepDokter = $this->resepDokter->create($request->dataObat[$i]);
                $this->track->insertSql($this->resepDokter, $request->dataObat[$i]);
            }
        } catch (QueryException $e) {
            return $this->errorResponse('Terjadi Kesalahan');
        }
        return $this->successResponse('Berhasil', "Berhasil menyimpan {$countArray} obat");
    }

    function get($no_resep)
    {
        $resepDokter = $this->resepDokter->where('no_resep', $no_resep)
            ->with(['dataBarang' => function ($q) {
                return $q->with('kodeSatuan')->select(['kode_brng', 'nama_brng', 'kode_sat']);
            }])
            ->get();
        return $this->successResponse($resepDokter);
    }

    function delete(Request $request)
    {
        try {
            $data =  [
                'no_resep' => $request->no_resep,
                'kode_brng' => $request->kode_brng,
            ];
            $resepDokter = $this->resepDokter->where($data)->delete();
            $this->track->deleteSql($this->resepDokter, $data);
        } catch (QueryException $e) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    function update(Request $request)
    {
        try {
            $clause = [
                'no_resep' => $request->no_resep,
                'kode_brng' => $request->kode_brng,
            ];

            $data = [
                'jml' => $request->jml,
                'aturan_pakai' => $request->aturan_pakai,
            ];

            $resepDokter = $this->resepDokter->where($clause)->update($data);
            $this->track->updateSql($this->resepDokter, $data, $clause);
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal mengubah obat', 400, $e->errorInfo);
        }
        return $this->successResponse($data);
    }
}
