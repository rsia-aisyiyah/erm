<?php

namespace App\Http\Controllers;

use App\Action\TindakanDokterAction;
use App\Models\TindakanDokter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanDokterController extends Controller
{
	public $track;
	public TindakanDokterAction $tindakan;
	public TindakanDokter $model;

	public function __construct(TindakanDokterAction $tindakan, TindakanDokter $model)
	{
		$this->track = new TrackerSqlController();
		$this->tindakan = $tindakan;
		$this->model = $model;
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->all();

		try {
			$tindakan = $this->tindakan->handleCreate($data);

		} catch (Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);

		}
		return response()->json($data['tindakan']);
	}

	public function get(Request $request): JsonResponse
	{
		$data = $this->model->with(['tindakan', 'dokter', 'pasien', 'regPeriksa'])
			->where('no_rawat', $request->no_rawat)->get();
		return response()->json($data, 200);
	}

	function delete(Request $request) : JsonResponse
	{
		$data = $request->all();
		try {
			$tindakan = $this->tindakan->handleDelete($data);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);
		}
		return response()->json('Sukses', 200);
	}

}
