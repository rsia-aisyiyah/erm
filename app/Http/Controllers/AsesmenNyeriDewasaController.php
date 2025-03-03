<?php

namespace App\Http\Controllers;

use App\Models\AsesmenNyeriDewasa;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AsesmenNyeriDewasaController extends Controller
{
    protected $model;
    protected $track;

    public function __construct()
    {
        $this->model = new AsesmenNyeriDewasa();
        $this->track = new TrackerSqlController();
    }

    function first(Request $request){
        $no_rawat = $request->no_rawat;
        $tanggal = $request->tanggal;
        $data = $this->model->where('no_rawat', $no_rawat)
        ->where('tanggal', $tanggal)
        ->with(['petugas'])
        ->first();
        return response()->json($data);
    }
    function get(Request $request){
        $no_rawat = $request->no_rawat;
        
        $data = $this->model->where('no_rawat', $no_rawat)
        ->with(['petugas'])
        ->get();
       return response()->json($data);
    }
    function create(Request $request){
        $validate = $request->validate([
            'tanggal' => 'required',
            'pemicu' => 'required',
            'kualitas' => 'required',
            'lokasi' => 'required',
            'penanganan_non_farmakologi' => 'required',
            'skala' => 'required',
            'waktu' => ['required', 'min:5'],
        ]);
     

        $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'pemicu' => $request->pemicu,
            'pemicu_lain' => $request->pemicu_lain,
            'kualitas' => $request->kualitas,
            'kualitas_lain' => $request->kualitas_lain,
            'lokasi' => $request->lokasi,
            'lokasi_lain' => $request->lokasi_lain,
            'penanganan_farmakologi' => $request->penanganan_farmakologi,
            'penanganan_non_farmakologi' => $request->penanganan_non_farmakologi,
            'penanganan_non_farmakologi_lain' => $request->penanganan_non_farmakologi_lain,
            'skala' => $request->skala,
            'ket_skala' => $request->ket_skala,
            'waktu' => $request->waktu,
            'nip' => session()->get('pegawai')->nik
        ];

        $model = $this->model->where('no_rawat', $data['no_rawat'])
        ->where('tanggal', $data['tanggal']);
        if($model->first()){
            return $this->update($request);
        }

        try{
            $create = $this->model->create($data);
            if($create){
                $this->track->insertSql($this->model, $data);
            }
        }catch(QueryException $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json('Success', 201);
    }
    function delete(Request $request){
        $keys = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => $request->tanggal,
            'nip' => session()->get('pegawai')->nik
        ];

        $model = $this->model->where($keys);

        if($model->first()){
            try{
                $delete = $model->delete();
                if($delete){
                    $this->track->deleteSql($this->model, $keys);
                }
            }catch(QueryException $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return response()->json('Success', 201);
        }

        return response()->json('Tidak dapat menghapus data, silahka hubungi petugas yang bersangkutan', 400);

    }

    function update(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'pemicu' => 'required',
            'kualitas' => 'required',
            'lokasi' => 'required',
            'penanganan_non_farmakologi' => 'required',
            'skala' => 'required',
            'waktu' => ['required', 'min:5'],
        ]);
        $data = [
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'pemicu' => $request->pemicu,
            'pemicu_lain' => $request->pemicu_lain,
            'kualitas' => $request->kualitas,
            'kualitas_lain' => $request->kualitas_lain,
            'lokasi' => $request->lokasi,
            'lokasi_lain' => $request->lokasi_lain,
            'penanganan_farmakologi' => $request->penanganan_farmakologi,
            'penanganan_non_farmakologi' => $request->penanganan_non_farmakologi,
            'penanganan_non_farmakologi_lain' => $request->penanganan_non_farmakologi_lain,
            'skala' => $request->skala,
            'ket_skala' => $request->ket_skala,
            'waktu' => $request->waktu,
        ];

        $keys = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => $request->tanggal,
            'nip' => session()->get('pegawai')->nik
        ];

        try{
            $update = $this->model->where($keys)->update($data);
            if($update){
                $this->track->updateSql($this->model, $data, $keys);
            }
        }catch(QueryException $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json('Success', 201);
    }


}
