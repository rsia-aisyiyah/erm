<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPersalinan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RiwayatPersalinanController extends Controller
{
    protected $persalinan;
    protected $track;
    public function __construct()
    {
        $this->persalinan = new RiwayatPersalinan();
        $this->track = new TrackerSqlController();
    }
    function get($no_rkm_medis)
    {
        $persalinan = $this->persalinan->where('no_rkm_medis', $no_rkm_medis)->get();
        return response()->json($persalinan);
    }
    function insert(Request $request)
    {
        $data = $request->validate([
            'no_rkm_medis' => 'required',
            'tgl_thn' => 'required',
            'tempat_persalinan' => 'nullable',
            'usia_hamil' => 'nullable',
            'jenis_persalinan' => 'nullable',
            'penolong' => 'nullable',
            'penyulit' => 'nullable',
          'jk' => ['nullable', Rule::in(['L', 'P'])],
            'bbpb' => 'nullable',
            'keadaan' => 'nullable',
        ]);

        try {
            $persalinan = $this->persalinan->create($data);
            $this->track->insertSql($this->persalinan, $data);
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
        return response()->json($persalinan);
    }
    public function delete(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_rkm_medis' => 'required',
            'tgl_thn' => 'required',
        ]);

        $clause = [
            'no_rkm_medis' => $request->no_rkm_medis,
            'tgl_thn' => $request->tgl_thn,
        ];

        try {
            // Cek apakah data ada sebelum dihapus
            $data = $this->persalinan->where($clause)->first();

            if (!$data) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            // Hapus data
            $deleted = $data->delete();

            // Log ke track
            $this->track->deleteSql($this->persalinan, $clause);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
