<?php

namespace App\Http\Controllers;

use App\Action\TindakanDokterRanapAction;
use App\Models\TindakanDokterRanap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanDokterRanapController extends Controller
{
	public TindakanDokterRanapAction $action;
	public TindakanDokterRanap $model;

	public function __construct(TindakanDokterRanapAction $action, TindakanDokterRanap $model)
	{
		$this->model = $model;
		$this->action = $action;
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->all();
		try {
			$tindakan = $this->action->handleCreate($data);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}

		return response()->json($data['tindakan']);
	}

	public function get(Request $request): JsonResponse
	{
		$data = TindakanDokterRanap::where('no_rawat', $request->no_rawat)
			->with(['tindakan', 'pasien', 'dokter', 'regPeriksa', 'kamarInap'])
			->orderBy('tgl_perawatan', 'DESC')
			->orderBy('jam_rawat', 'ASC')
			->limit(100)
			->get();

		return response()->json($data);
	}

	public function delete(Request $request): JsonResponse
	{
		$data = $request->all();

		try {
			$tindakan = $this->action->handleDelete($data);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
		return response()->json('Berhasil menghapus');
	}
}
