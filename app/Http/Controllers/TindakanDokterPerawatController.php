<?php

namespace App\Http\Controllers;

use App\Action\TindakanDokterPerawatAction;
use App\Models\TindakanDokterPerawat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanDokterPerawatController extends Controller
{
    public TindakanDokterPerawat $model;
	public TindakanDokterPerawatAction $action;

	public function __construct(TindakanDokterPerawat $mode, TindakanDokterPerawatAction $action){
		$this->model = $mode;
		$this->action = $action;
	}

	public function get(Request $request){
		$data = $this->model->where('no_rawat', $request->no_rawat)
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
			return $tindakan = $this->action->handleDelete($data);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);
		}
		return response()->json('Sukses', 200);
	}
}
