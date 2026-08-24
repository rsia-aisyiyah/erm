<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsesmenGeriatri;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AsesmenGeriatriController extends Controller
{
    protected $model;
    protected $track;

    public function __construct()
    {
        $this->model = new RsiaAsesmenGeriatri();
        $this->track = new TrackerSqlController();
    }

    public function get(Request $request)
    {
        $data = $this->model->where('no_rawat', $request->no_rawat)
            ->with(['perawat', 'dokter', 'dokterRuangan', 'regPeriksa.pasien', 'regPeriksa.dokter', 'regPeriksa.poliklinik'])
            ->first();

        return response()->json($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $data = $request->except(['_token']);
        $data['tanggal'] = date('Y-m-d H:i:s');
        
        if (empty($data['nip_perawat']) && session()->has('pegawai')) {
            $data['nip_perawat'] = session()->get('pegawai')->nik;
        }

        $existing = $this->model->where('no_rawat', $request->no_rawat)->first();

        if ($existing) {
            return $this->update($request);
        }

        try {
            $create = $this->model->create($data);
            if ($create) {
                $this->track->insertSql($this->model, $data);
            }
            return response()->json(['status' => 'success', 'data' => $data], 201);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'errorInfo' => $e->errorInfo], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        $data['tanggal'] = date('Y-m-d H:i:s');

        try {
            $update = $this->model->where('no_rawat', $request->no_rawat)->update($data);
            if ($update) {
                $this->track->updateSql($this->model, $data, ['no_rawat' => $request->no_rawat]);
                return response()->json(['status' => 'success update', 'data' => $data], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'errorInfo' => $e->errorInfo], 500);
        }

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function print(Request $request)
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        $get = $this->model->where('no_rawat', $request->no_rawat)
            ->with(['perawat', 'dokter', 'dokterRuangan', 'regPeriksa.pasien', 'regPeriksa.dokter', 'regPeriksa.poliklinik'])
            ->first();

        if (!$get) {
            return response()->json(['message' => 'Data Asesmen Geriatri tidak ditemukan'], 404);
        }

        $pdf = Pdf::loadView('content.print.asesmen_geriatri', ['data' => $get]);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('asesmen_geriatri_' . str_replace('/', '-', $request->no_rawat) . '.pdf');
    }
}
