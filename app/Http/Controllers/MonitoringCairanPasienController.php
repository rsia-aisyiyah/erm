<?php

namespace App\Http\Controllers;

use App\Models\MonitoringCairanPasien;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MonitoringCairanPasienController extends Controller
{
    private $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    public function get(Request $request)
    {
        $query = MonitoringCairanPasien::where('no_rawat', $request->no_rawat)
            ->with('regPeriksa', 'pasien', 'petugas')
            ->get();
        return DataTables::of($query)->make(true);
    }

    public function create(Request $request)
    {

        try {
            $data = [
                'no_rawat' => $request->no_rawat,
                'suhu_tubuh' => $request->suhu_tubuh,
                'tensi' => $request->tensi,
                'nadi' => $request->nadi,
                'cairan_lambung' => $request->cairan_lambung,
                'cairan_drain' => $request->cairan_drain,
                'lainnya' => $request->lainnya,
                'jumlah_carian_infus' => $request->jumlah_carian_infus,
                'jumlah_tetes_permenit' => $request->jumlah_tetes_permenit,
                'jumlah_urine' => $request->jumlah_urine,
                'tgl_perawatan' => date('Y-m-d'),
                'jam_rawat' => date('H:i:s'),
                'nip' => session()->get('pegawai')->nik,
            ];

            $create = MonitoringCairanPasien::create($data);
            if ($create) {
                $this->track->insertSql(new MonitoringCairanPasien(), $data);
            }
            return response()->json('Berhasil');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }

    public function delete(Request $request)
    {
        $key = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        try {
            $delete = MonitoringCairanPasien::where($key)->delete();
            if ($delete) {
                $this->track->deleteSql(new MonitoringCairanPasien(), $key);
            }
            return response()->json('Berhasil');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
}
