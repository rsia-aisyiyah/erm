<?php

namespace App\Http\Controllers;

use App\Action\TindakanDokterPerawatRanapAction;
use App\Models\TindakanDokterPerawat;
use App\Models\TindakanDokterPerawatRanap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanDokterPerawatRanapController extends Controller
{
	public TindakanDokterPerawatRanap $model;
	public TindakanDokterPerawatRanapAction $action;

	public function __construct(TindakanDokterPerawatRanap $model, TindakanDokterPerawatRanapAction $action){
		$this->model = $model;
		$this->action = $action;
	}

	public function get(Request $request){
		$data = $this->model
			->where('no_rawat', $request->no_rawat)
			->with(['tindakan', 'petugas','dokter', 'pasien', 'regPeriksa'])
			->get();
		return response()->json($data);
	}

	public function create(Request $request)
	{
		$data = $request->all();

		try {
			$tindakan = $this->action->handleCreate($data);

		} catch (Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);

		}
		return response()->json($data['tindakan']);
	}

	function delete(Request $request) : JsonResponse|array
	{
		$data = $request->all();
		try {
			$tindakan = $this->action->handleDelete($data);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);
		}
		return response()->json('Sukses', 200);
	}
}
