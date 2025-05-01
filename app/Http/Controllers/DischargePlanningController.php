<?php

namespace App\Http\Controllers;

use App\Models\DischargePlanning;
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

    function create(Request $request){
        $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s'),
            'rencana_rawat' => $request->rencana_rawat,
            'tgl_rencana_pulang' => date('Y-m-d H:i:s', strtotime($request->tgl_rencana_pulang)),
            'diagnosa_keluar' => $request->diagnosa_keluar,
            'kondisi_pulang' => $request->kondisi_pulang,
            'mobilisasi' => $request->mobilisasi,
            'alat_terpasang' => $request->alat_terpasang,
            'penyuluhan' => $request->penyuluhan,
            'penyuluhan_lain' => $request->penyuluhan_lain,
            'dokumen_penunjang' => $request->dokumen_penunjang,
            'obat_pulang' => $request->obat_pulang,
            'diet_dirumah' => $request->diet_dirumah,
            'instruksi' => $request->instruksi,
            'nip' => session()->get('pegawai')->nik
        ];

        $validate = $request->validate([
            'rencana_rawat' => ['required', 'integer', 'min:0', 'gt:0'],
            'tgl_rencana_pulang' => 'required',
            'diagnosa_keluar' => 'required',
        ]);
    
        $get = $this->modal->where('no_rawat', $request->no_rawat)
            ->with(['petugas'])
            ->first();

        if($get){
            return $this->update($request);
        }
        try{
            $create = $this->modal->create($data);
            if($create){
                $this->track->insertSql($this->modal, $data);
            }
        }catch(QueryException $e){
            return response()->json($e->errorInfo, 500);
        }
        return response()->json(['status' => 'success', 'data' => $data], 201);
    }

    function get(Request $request){
        $get = $this->modal->where('no_rawat', $request->no_rawat)
        ->with(['petugas'])
        ->first();
        return response()->json($get);
    }

    function update(Request $request)
    {
         $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s'),
            'rencana_rawat' => $request->rencana_rawat,
            'tgl_rencana_pulang' => date('Y-m-d H:i:s', strtotime($request->tgl_rencana_pulang)),
            'diagnosa_keluar' => $request->diagnosa_keluar,
            'kondisi_pulang' => $request->kondisi_pulang,
            'mobilisasi' => $request->mobilisasi,
            'alat_terpasang' => $request->alat_terpasang,
            'penyuluhan' => $request->penyuluhan,
            'penyuluhan_lain' => $request->penyuluhan_lain,
            'dokumen_penunjang' => $request->dokumen_penunjang,
            'obat_pulang' => $request->obat_pulang,
            'diet_dirumah' => $request->diet_dirumah,
            'instruksi' => $request->instruksi,
            'nip' => session()->get('pegawai')->nik
        ];

        $validate = $request->validate([
            'rencana_rawat' => ['required', 'integer', 'min:0', 'gt:0'],
            'tgl_rencana_pulang' => 'required',
            'diagnosa_keluar' => 'required',
        ]);
       
          if($data['nip'] !== $request->nip){
             return response()->json('Anda tidak dapat mengubah data ini, Hubungi perawat penanggung jawab pasien', 401);
        }

        try{
            $update = $this->modal->where('no_rawat', $request->no_rawat)->update($data);
            if($update){
                $this->track->updateSql($this->modal, $data, ['no_rawat' => $request->no_rawat]);
                return response()->json(['status' => 'success update', 'data' => $data], 200);
            }
        }catch(QueryException $e){
            return response()->json($e->errorInfo, 500);
        }
        return response()->json(null, 200);


    }
}
