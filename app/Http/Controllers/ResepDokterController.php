<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
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
}
