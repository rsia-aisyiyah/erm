<?php

namespace App\Http\Controllers;

use App\Action\TindakanDokterAction;
use App\Action\TindakanPerawatAction;
use App\Models\TindakanPerawat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TindakanPerawatController extends Controller
{
    public TindakanPerawat $model;
	public TindakanPerawatAction $action;

	public function __construct(TindakanPerawat $model, TindakanPerawatAction $action){
		$this->model = $model;
		$this->action = $action;
	}

	public function get(Request $request){
		$data = $this->model->where('no_rawat', $request->no_rawat)
			->with(['tindakan', 'petugas', 'pasien', 'regPeriksa'])
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
