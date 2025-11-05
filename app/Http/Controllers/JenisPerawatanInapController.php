<?php

namespace App\Http\Controllers;

use App\Models\JenisPerawatanInap;
use Illuminate\Http\Request;

class JenisPerawatanInapController extends Controller
{
    public JenisPerawatanInap $model;

	public function __construct(JenisPerawatanInap $model) {
		$this->model = $model;
	}

	public function dataTable(Request $request, string $params = '')
	{
		$data = $this->model->with(['kategori', 'penjab', 'bangsal'])
			->where('status', '1')->orderBy('kd_jenis_prw', 'asc');
		if ($request->kd_kategori) {
			$data = $data->where('kd_kategori', $request->kd_kategori);
		}
		if ($request->kd_pj) {
			$data = $data->where('kd_pj', $request->kd_pj);
		}
		if ($request->kd_poli) {
			$data = $data->where('kd_poli', $request->kd_poli);
		}

		if($params=='dr'){
			$data = $data->where('total_byrdr', '!=', 0)
				->where('total_byrpr', '==', 0)
				->where('total_byrdrpr', '==', 0);
		}else if( $params=='pr'){
			$data = $data->where('total_byrdr', '==', 0)
				->where('total_byrpr', '!=', 0)
				->where('total_byrdrpr', '==', 0);
		}else if($params=='drpr'){
			$data = $data
				->where('total_byrdrpr', '!=', 0);
		}

		return datatables()->of($data)
			->addColumn('_checked', function ($row) {
				return false;
			})
			->make(true);
	}
}
