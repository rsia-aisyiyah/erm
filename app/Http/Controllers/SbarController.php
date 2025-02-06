<?php

namespace App\Http\Controllers;

use App\Models\GrafikHarian;
use App\Models\PemeriksaanRanap;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SbarController extends Controller
{
   public function update(Request $request){
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


        try{
            DB::transaction(function () use ($data, $clause, $request)  {
                    PemeriksaanRanap::where($clause)->update($data);
                    $konsul = new RsiaKonsulSbarController();
                    $grafik = new RsiaGrafikHarianController();
                    $log = new RsiaLogSoapController();
                    $log->insert($request, 'Update');
                    $grafik->updateSbar($request);
                    $konsul->update($request);
            });
        }catch(QueryException $e){
            return response()->json($e->errorInfo, 500);
        }

        return response()->json('SUKSES');
   }
}
