<?php

namespace App\Http\Controllers;

use App\DataTables\SbarDataTable;
use App\Models\GrafikHarian;
use App\Models\PemeriksaanRanap;
use App\Models\RsiaKonsulSbar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SbarController extends Controller
{
    protected $track;
    function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    public function update(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan_awal,
            'jam_rawat' => $request->jam_rawat_awal,
        ];

        $data = [
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
            'keluhan' => $request->keluhan,
            'pemeriksaan' => $request->pemeriksaan,
            'penilaian' => $request->penilaian,
            'rtl' => $request->rtl,
        ];


        try {
            DB::transaction(function () use ($data, $clause, $request) {
                PemeriksaanRanap::where($clause)->update($data);
                $konsul = new RsiaKonsulSbarController();
                $grafik = new RsiaGrafikHarianController();
                $log = new RsiaLogSoapController();
                $log->insert($clause, 'Update');
                $grafik->updateSbar($request);
                $konsul->update($request);
            });
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }

        return response()->json('SUKSES');
    }

    function delete(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        try {
            DB::transaction(function () use ($clause) {
                $pemeriksaan = PemeriksaanRanap::where($clause)->delete();
                $grafik = new RsiaGrafikHarianController();
                $konsul = new RsiaKonsulSbarController();
                $grafik->delete(new Request($clause), 'SBAR');
                $konsul->delete(new Request($clause));
            });
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        $this->track->deleteSql(new PemeriksaanRanap(), $clause);
        return response()->json('SUKSES');
    }

    function dataTable(SbarDataTable $dataTable)
    {
        return $dataTable->ajax();
    }
}
