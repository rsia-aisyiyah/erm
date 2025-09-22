<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepDokterRacikan;
use App\Http\Controllers\Controller;
use App\Models\ResepDokterRacikanDetail;
use App\Http\Controllers\TrackerSqlController;
use App\Http\Controllers\ResepDokterRacikanDetailController;
use App\Models\RsiaMappingRacikan;
use App\Models\RsiaMappingRacikanDetail;
use Illuminate\Support\Facades\DB;

class ResepDokterRacikanController extends Controller
{
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
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with([
                    'metode',
                    'detail.databarang',
                    'detailRacikan' => function ($q) use ($request) {
                        $q->where('no_racik', $request->no_racik);
                    }
                ])->first();
            } else {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->with(['metode', 'detailRacikan.dataBarang', 'detail.databarang'])->get();
            }
        }
        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $this->getNomorRacikan($request->no_resep),
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => $request->keterangan,
        ];

        $mapping = new RsiaMappingRacikanDetail();
        $detail = $mapping->where('id_racik', $request->id_template)
            ->with(['dataBarang'])
            ->get();

        $dataDetail = $detail->map(function ($item) use ($data) {
            return [
                'no_resep' => $data['no_resep'],
                'no_racik' => $data['no_racik'],
                'kode_brng' => $item->kode_brng,
                'p1' => 1,
                'p2' => 1,
                'kandungan' => $item->dataBarang->kapasitas,
                'jml' => $data['jml_dr'],
            ];
        });

        try {
            DB::transaction(function () use ($data, $dataDetail) {
                $resep = ResepDokterRacikan::create($data);
                $detail = ResepDokterRacikanDetail::insert($dataDetail->toArray());
                if ($resep) {
                    $this->track->insertSql($this->resep, $data);
                }
            });

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
        return response()->json([
            'message' => 'Data Berhasil Disimpan',
            'data' => [
                'no_resep' => $data['no_resep'],
                'no_racik' => $data['no_racik']
            ]

        ], 201);
    }

    public function hapus(Request $request)
    {
        $clause = [
            'no_racik' => $request->no_racik,
            'no_resep' => $request->no_resep
        ];
        $resepDetail = $this->resepDetail->hapus($request);
        $resep = ResepDokterRacikan::where($clause)->delete();
        $this->track->deleteSql($this->resep, $clause);
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
        ];
        $resep = ResepDokterRacikan::where($clause)->update($data);
        $this->track->updateSql($this->resep, $data, $clause);
        return response()->json($request);
    }

    function getNomorRacikan(int|string $no_resep)
    {
        $nomor = ResepDokterRacikan::where('no_resep', $no_resep)->max('no_racik');
        return $nomor + 1;
    }
}
