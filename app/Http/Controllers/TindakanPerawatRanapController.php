<?php

namespace App\Http\Controllers;

use App\Action\TindakanPerawatRanapAction;
use App\Models\TindakanPerawatRanap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanPerawatRanapController extends Controller
{
	public TindakanPerawatRanap $model;
	public TindakanPerawatRanapAction $action;

	public function __construct(TindakanPerawatRanap $model, TindakanPerawatRanapAction $action)
	{
		$this->model = $model;
		$this->action = $action;
	}

	public function get(Request $request)
	{
		$data = $this->model->where('no_rawat', $request->no_rawat)
			->with(['tindakan', 'petugas', 'pasien', 'regPeriksa', 'kamarInap'])
			->orderBy('tgl_perawatan', 'DESC')
			->orderBy('jam_rawat', 'DESC')
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
		return response()->json('sukses');
	}

	function delete(Request $request): JsonResponse|array
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
