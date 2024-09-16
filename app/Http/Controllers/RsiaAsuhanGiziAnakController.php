<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsuhanGiziAnak;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RsiaAsuhanGiziAnakController extends Controller
{
	protected TrackerSqlController $tracker;

	function __construct(TrackerSqlController $tracker){
		$this->tracker = $tracker;
	}
	function get(RsiaAsuhanGiziAnak $model, Request $request) : JsonResponse
	{
		$get = $model->where(['no_rawat' => $request->no_rawat])->first();
		if($get){
            return response()->json($get, 200);
        }
		return response()->json(null, 200);
	}
    function create(RsiaAsuhanGiziAnak $model, Request $request) : JsonResponse
    {
		$data = $request->except('_token');
		$data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();
		$isExist = $model->where('no_rawat', $data['no_rawat'])->first();
		if ($isExist) {
			return $this->update($model, $request);
		}

	    try {
			$create = $model->create($data);
			if($create){
				$this->tracker->insertSql($model, $data);
			}
	    }catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
	    }
		return response()->json('Berhasil', 200);
    }

	function update(RsiaAsuhanGiziAnak $model, Request $request) : JsonResponse
	{
		$data = $request->except('_token');
		$data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();

		try {
			$update = $model->where('no_rawat', $data['no_rawat'])->update($data);
            if($update){
                $this->tracker->updateSql($model, $data, ['no_rawat'=>$data['no_rawat']]);
            }
        }catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
		return response()->json('Berhasil', 200);
	}
}
