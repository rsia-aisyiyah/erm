<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\PlanOfCareTim;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PlanOfCareTimController extends Controller
{
    protected $track;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $data = $request->except('_token');
        $petugas = $data['petugas'];
        if (is_array($petugas)) {
            try {
                for ($i = 0; $i < count($petugas); $i++) {
                    $data = [
                        'no_rawat' => $data['no_rawat'],
                        'petugas' => $petugas[$i]
                    ];
                    $poc = PlanOfCareTim::create($data);
                    if ($poc) {
                        $this->track->insertSql(new PlanOfCareTim(), $data);
                    }
                }
                return response()->json('SUKSES', 201);
            } catch (QueryException $e) {
                return response()->json($e->errorInfo, 500);
            }
        }

        try {
            $data = [
                'no_rawat' => $data['no_rawat'],
                'petugas' => $petugas
            ];
            $poc = PlanOfCareTim::create($data);
            if ($poc) {
                $this->track->insertSql(new PlanOfCareTim(), $data);
            }
            return response()->json('SUKSES', 201);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
    function get(Request $request)
    {
        $poc = PlanOfCareTim::where('no_rawat', $request->no_rawat)->with('petugas')->get();
        return response()->json($poc);
    }
    function delete($id)
    {
        $delete = PlanOfCareTim::where('id', $id)->delete();
        if ($delete) {
            $this->track->deleteSql(new PlanOfCareTim(), ['id' => $id]);
        }
        return response()->json('SUKSES', 200);
    }
}
