<?php

namespace App\Http\Controllers;

use App\Models\PlanOfCare;
use App\Models\TrackerSql;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\TrackerSqlController;

class PlanOfCareController extends Controller
{
    protected $track;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    function get(Request $request)
    {
        $key = ['no_rawat' => $request->no_rawat];
        $poc = PlanOfCare::where($key)->with(['regPeriksa.dokter', 'regPeriksa.poliklinik', 'tim.petugas', 'petugas'])->first();

        return response()->json($poc);
    }
    function create(Request $request)
    {
        // $req =  $request->except('_token');
        $data = [
            'no_rawat' => $request->no_rawat,
            'petugas' => session()->get('pegawai')->nik,
            'anamnesa' => $request->anamnesa,
            'hubungan' => $request->hubungan,
            'diagnosa_kerja' => $request->diagnosa_kerja,
            'masalah' => $request->masalah,
            'tim_dokter' => $request->kd_dokter,
            'kewaspadaan' => $request->kewaspadaan,
            'pemeriksaan_penunjang' => $request->pemeriksaan_penunjang,
            'prosedur' => $request->prosedur,
            'nutrisi' => $request->diet,
            'aktivitas' => $request->aktivitas,
            'pengobatan' => $request->pengobatan,
            'keperawatan' => $request->keperawatan,
            'tindakan_rehab_medik' => $request->tindakan_rehab_medik,
            'konsultasi' => $request->konsultasi,
            'sasaran' => $request->sasaran,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal))
        ];


        $planOfCare = PlanOfCare::where('no_rawat', $data['no_rawat']);

        try {
            if ($planOfCare->first()) {
                $poc = $planOfCare->update($data);
                if ($poc) {
                    $this->track->updateSql(new PlanOfCare(), ['no_rawat', $data['no_rawat']], $data);
                }
                return response()->json('SUKSES', 200);
            }
            $poc = PlanOfCare::create($data);
            if ($poc) {
                $this->track->insertSql(new PlanOfCare(), $data);
            }
            return response()->json("SUKSES", 201);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
}
