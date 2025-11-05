<?php

namespace App\Http\Controllers;

use App\Models\TindakanDokterRanap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TindakanDokterRanapController extends Controller
{
	public function __construct()
	{

	}

	public function get(Request $request): JsonResponse
	{
		$data = TindakanDokterRanap::where('no_rawat', $request->no_rawat)
			->with(['tindakan', 'pasien', 'dokter', 'regPeriksa', 'kamarInap'])
			->limit(100)
			->get();

		return response()->json($data);
	}
}
