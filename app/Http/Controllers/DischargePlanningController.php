<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishcarePlanning;
use App\Models\DischargePlanning;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DischargePlanningController extends Controller
{
    protected $modal;
    protected $track;
    function __construct()
    {
        $this->modal = new DischargePlanning();
        $this->track = new TrackerSqlController();
    }

    function create(StoreDishcarePlanning $request)
    {

        $data = $request->validated();

        $isExist = $this->modal->find($request->no_rawat);

        if ($isExist) {
            return $this->update($request);
        }
        $data['tanggal'] = Carbon::now()->format('Y-m-d H:i:s');
        try {
            $create = $this->modal->create($data);
            if ($create) {
                $this->track->insertSql($this->modal, $data);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json(['status' => 'success', 'data' => $data], 201);
    }


    function update(StoreDishcarePlanning $request)
    {

        $data = $request->validated();
        $user = session()->get('pegawai')->nik;

        if ($user !== $request->nip) {
            return response()->json('Anda tidak dapat mengubah data ini, Hubungi perawat penanggung jawab pasien', 401);
        }

        try {

            $update = $this->modal->findOrFail($request->no_rawat);
            $update->fill($data);
            $update->save();
            if ($update) {
                $this->track->updateSql($this->modal, $data, ['no_rawat' => $request->no_rawat]);
                return response()->json(['status' => 'success update', 'data' => $data], 200);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json(null, 200);


    }

    public function get(Request $request)
    {

        try {
            $data = $this->modal->with(['petugas', 'regPeriksa.dokter', 'pasien'])->find($request->no_rawat);
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Request $request)
    {
        $nip = session()->get('pegawai')->nik;
        $nip2 = $request->nip;
        if ($nip !== $nip2) {
            return response()->json('Anda tidak dapat menghapus data ini, Hubungi perawat penanggung jawab pasien', 401);

        }

        $data = $this->modal->findOrFail($request->no_rawat);

        if (!$data) {
            return response()->json(['status' => 'not found'], 404);
        }

        try {
            $data->delete();
            $this->track->deleteSql($this->modal, ['no_rawat' => $request->no_rawat]);
            return response()->json(['status' => 'success delete'], 200);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }

    public function print(Request $request)
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        $get = $this->modal->where('no_rawat', $request->no_rawat)
            ->with(['petugas', 'regPeriksa.dokter', 'pasien'])
            ->first();

        return Pdf::loadView(
            'content.print.discharge_planning',
            ['data' => $get]
        )->stream('pdf_discharge_planning_' . $request->no_rawat . '.pdf');

    }
}