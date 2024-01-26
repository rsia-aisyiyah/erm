<?php

namespace App\Http\Controllers;

use App\Models\SkriningTb;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SkriningTbController extends Controller
{
    protected $track;
    function __construct()
    {
        $this->track = new TrackerSqlController();
    }


    function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_dokter' => $request->kd_dokter,
            'kontak' => $request->kontak,
            'demam' => $request->demam,
            'berat' => $request->berat,
            'batul' => $request->batul,
            'pembesaran' => $request->pembesaran,
            'pembengkakan' => $request->pembengkakan,
            'thorax' => $request->thorax,
            'mantoux' => $request->mantoux,
            'ket_kontak' => $request->ket_kontak,
            'ket_mantoux' => $request->ket_mantoux,
            'ket_berat' => $request->ket_berat,
            'ket_demam' => $request->ket_demam,
            'ket_batul' => $request->ket_batul,
            'ket_pembesaran' => $request->ket_pembesaran,
            'ket_pembengkakan' => $request->ket_pembengkakan,
            'ket_thorax' => $request->ket_thorax,
            'total_skrining' => $request->total_skrining,
            'tgl_skrining' => date('Y-m-d'),
            'jam_skrining' => date('H:i:s'),
        ];
        if ($request->id) {
            $find = SkriningTb::where('id', $request->id)->first();
            if ($find) {
                $this->update($request);
                return true;
            }
        }

        try {
            $skrining = SkriningTb::create($data);
            if ($skrining) {
                $this->track->insertSql(new SkriningTb(), $data);
            }
            return response('SUKSES', 201);
        } catch (QueryException $e) {
            return response($e->errorInfo, 500);
        }
    }

    function get(Request $request)
    {
        $skrining = new SkriningTb();
        if ($request->id) {
            $skrining = $skrining->where('id', $request->id)->first();
        }
        if ($request->no_rawat) {
            $skrining = $skrining->where('no_rawat', $request->no_rawat)->get();
        }

        if ($request->dataTable) {
            return DataTables::of($skrining)->make(true);
        }

        return response()->json($skrining);
    }

    function update(Request $request)
    {
        $data = [
            'kontak' => $request->kontak,
            'demam' => $request->demam,
            'berat' => $request->berat,
            'batul' => $request->batul,
            'pembesaran' => $request->pembesaran,
            'pembengkakan' => $request->pembengkakan,
            'thorax' => $request->thorax,
            'mantoux' => $request->mantoux,
            'ket_kontak' => $request->ket_kontak,
            'ket_mantoux' => $request->ket_mantoux,
            'ket_berat' => $request->ket_berat,
            'ket_demam' => $request->ket_demam,
            'ket_batul' => $request->ket_batul,
            'ket_pembesaran' => $request->ket_pembesaran,
            'ket_pembengkakan' => $request->ket_pembengkakan,
            'ket_thorax' => $request->ket_thorax,
            'total_skrining' => $request->total_skrining,
        ];
        try {
            $skrining = SkriningTb::where('id', $request->id)->update($data);
            if ($skrining) {
                $this->track->updateSql(new SkriningTb(), $data, ['id' => $request->id]);
            }
            return response()->json('SUKSES');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function delete(Request $request)
    {
        $skrining = SkriningTb::where('id', $request->id);
        $getNoRawat = $skrining->select('no_rawat')->first();
        try {
            $delete = $skrining->delete();
            if ($delete) {
                $this->track->deleteSql(new SkriningTb(), ['id' => $request->id]);
            }
            return response()->json($getNoRawat);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
}
