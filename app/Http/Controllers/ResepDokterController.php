<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Models\ResepObat;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResepDokterController extends Controller
{
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
            $resepDokter->limit(10)->get();
        }

        return response()->json($hasil, 200);
    }
    public function get(int|string $no_resep)
    {
        $resepDokter = $this->resepDokter->where('no_resep', $no_resep)
            ->with('dataBarang.kodeSatuan')->get();
        return response()->json($resepDokter);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng,
            'jml' => $request->jml,
            'aturan_pakai' => $request->aturan_pakai,
        ];

        if ($this->isExist($request)) {
            return response()->json(['message' => 'Obat sudah ada'], 500);
        }
        $resepDokter = $this->resepDokter->create($data);
        $this->track->insertSql($this->resepDokter, $data);
        return response()->json($resepDokter);
    }
    public function hapus(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng,
        ];
        try {

            $resepDokter = $this->resepDokter->where($data)->delete();
            if ($resepDokter) {
                $this->track->deleteSql($this->resepDokter, $data);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
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
        try {
            $resepDokter = $this->resepDokter->where($clause)->update($data);
            if ($resepDokter) {
                $this->track->updateSql($this->resepDokter, $data, $clause);
            }

        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('Data berhasil diubah');
    }

    protected function isExist(Request $request): bool
    {
        $resepDokter = $this->resepDokter
            ->where('no_resep', $request->no_resep)
            ->where('kode_brng', $request->kode_brng)->first();

        return $resepDokter ? true : false;
    }

    protected function isResepAvalilable($no_resep)
    {
        if (!$no_resep) {

        }
    }
}
