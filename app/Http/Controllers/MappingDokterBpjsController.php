<?php

namespace App\Http\Controllers;

use App\Models\MappingDokterBpjs;
use Illuminate\Http\Request;

class MappingDokterBpjsController extends Controller
{
	public $model;

	public function __construct(MappingDokterBpjs $model)
	{
		$this->model = $model;
	}

	public function get(Request $request)
	{
		$result = $this->model->where('kd_dokter_bpjs', $request->nm_dokter)
			->orWhere('kd_dokter', $request->nm_dokter)
			->orWhere('nm_dokter_bpjs','like', '%'.$request->nm_dokter.'%')
			->with('dokter')
			->get();
		return response()->json($result);
	}
}
