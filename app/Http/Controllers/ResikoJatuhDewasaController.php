<?php

namespace App\Http\Controllers;

use App\DataTables\ResikoJatuhDewasaDataTable;
use App\Http\Requests\ResikoJatuhDewasa as RequestsResikoJatuhDewasa;
use App\Models\ResikoJatuhDewasa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResikoJatuhDewasaController extends Controller
{
    protected $model;
    protected $track;

    function __construct(ResikoJatuhDewasa $model)
    {
        $this->track = new TrackerSqlController();
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model->all();
        return view('asesmen.resiko-jatuh.dewasa.index', compact('data'));
    }
    function get(Request $req)
    {
        $no_rawat = $req->no_rawat;
        $tanggal = date('Y-m-d H:i:s', strtotime($req->tanggal));
        if ($req->tanggal) {
            $data = $this->model
                ->with(['petugas', 'pasien', 'regPeriksa'])
                ->where(['tanggal' => $tanggal, 'no_rawat' => $no_rawat])->first();
        } else {
            $data = $this->model
                ->with(['petugas', 'pasien', 'regPeriksa'])
                ->where('no_rawat', $no_rawat)->get();

        }
        return response()->json($data, 200);
    }

    public function create(RequestsResikoJatuhDewasa $req)
    {
        $data = $req->validated();
        $data['tanggal'] = date('Y-m-d H:i:s', strtotime($data['tanggal']));
        try {
            $create = $this->model->create($data);
            if ($create) {
                $this->track->insertSql($this->model, $data);
                return response()->json(['status' => true, 'message' => 'Data Berhasil Disimpan'], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
    function update(RequestsResikoJatuhDewasa $req)
    {
        $data = $req->validated();
        $data['tanggal'] = date('Y-m-d H:i:s', strtotime($data['tanggal']));
        $key =
            [
                'no_rawat' => $data['no_rawat'],
                'tanggal' => $data['tanggal']
            ];
        try {
            $update = $this->model->where($key)->update($data);
            if ($update) {
                $this->track->updateSql($this->model, $data, $key);
                return response()->json(['status' => true, 'message' => 'Data Berhasil Disimpan'], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    function delete(Request $req)
    {
        $no_rawat = $req->no_rawat;
        $tanggal = $req->tanggal;
        $nip = session()->get('pegawai')->nik;
        try {
            $delete = $this->model->where('no_rawat', $no_rawat)->where('tanggal', $tanggal)->where('nip', $nip)->delete();
            if ($delete) {
                $this->track->deleteSql($this->model, ['no_rawat' => $no_rawat, 'tanggal' => $tanggal, 'nip' => $nip]);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json('Success', 200);
    }
}
