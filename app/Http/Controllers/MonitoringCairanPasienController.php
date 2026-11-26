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
            ->orderByDesc('tgl_perawatan')
            ->orderByDesc('jam_rawat')
            ->get();
        return DataTables::of($query)->make(true);
    }

    public function create(Request $request)
    {
        if (!$request->filled('no_rawat')) {
            return response()->json([
                'message' => 'Nomor rawat tidak ditemukan.',
            ], 422);
        }

        $clean = function ($val): string {
            $s = trim((string) ($val ?? ''));
            return $s === '' ? '-' : $s;
        };

        try {
            $data = [
                'no_rawat' => $request->no_rawat,
                'suhu_tubuh' => $clean($request->suhu_tubuh),
                'tensi' => $clean($request->tensi),
                'nadi' => $clean($request->nadi),
                'cairan_lambung' => $clean($request->cairan_lambung),
                'cairan_drain' => $clean($request->cairan_drain),
                'lainnya' => $clean($request->lainnya),
                'jumlah_carian_infus' => $clean($request->jumlah_carian_infus),
                'jumlah_tetes_permenit' => $clean($request->jumlah_tetes_permenit),
                'jumlah_urine' => $clean($request->jumlah_urine),
                'tgl_perawatan' => $request->filled('tgl_perawatan') ? $request->tgl_perawatan : date('Y-m-d'),
                'jam_rawat' => $request->filled('jam_rawat') ? $request->jam_rawat : date('H:i:s'),
                'nip' => session()->get('pegawai')->nik,
            ];

            $create = MonitoringCairanPasien::create($data);
            if ($create) {
                $this->track->insertSql(new MonitoringCairanPasien(), $data);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data monitoring cairan berhasil disimpan.',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data monitoring cairan.',
                'error' => $e->errorInfo,
            ], 500);
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
            return response()->json([
                'success' => true,
                'message' => 'Data monitoring cairan berhasil dihapus.',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data monitoring cairan.',
                'error' => $e->errorInfo,
            ], 500);
        }
    }
}
