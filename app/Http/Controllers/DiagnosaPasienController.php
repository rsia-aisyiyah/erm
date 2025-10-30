<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosaPasienController extends Controller
{


	protected $diagnosa;
	protected $track;

	public function __construct()
	{

		$this->prosedur = new DiagnosaPasien();
		$this->track = new TrackerSqlController();
	}

	public function tambah(Request $request)
	{
		$penyakit = $this->prosedur->create([
			'no_rawat' => $request->no_rawat,
			'kd_penyakit' => $request->kd_penyakit,
			'status' => $request->status,
			'prioritas' => $request->prioritas,
		]);

		return response()->json($penyakit);
	}

	public function insert(Request $request)
	{
		try {
			DB::transaction(function () use ($request) {
				$this->hapus($request);
				$create = $this->prosedur->insert($request->data);
				if ($create) {
					foreach ($request->data as $item) {
						$this->track->insertSql($this->prosedur, $item);
					}
				}
			});
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}

		return response()->json('Success', 200);
	}

	public function ambil(Request $request)
	{

		$penyakit = $this->prosedur->with('penyakit')
			->where('no_rawat', $request->no_rawat)
			->orderBy('prioritas', 'ASC')->get();

		return response()->json($penyakit);
	}

	public function hapus(Request $request)
	{
		try {
			$penyakit = $this->prosedur->where('no_rawat', $request->no_rawat);
			$key = ['no_rawat' => $request->no_rawat];
			if ($request->kd_penyakit) {
				$key['kd_penyakit'] = $request->kd_penyakit;
				$penyakit = $penyakit->where('kd_penyakit', $request->kd_penyakit)->delete();
			}

			$penyakit = $penyakit->delete();
			if ($penyakit) {
				$this->track->deleteSql($this->prosedur, $key);
			}
		} catch (\Exception $e) {
			return response($e->getMessage(), 500);
		}

		return response()->json('Deleted');
	}
}
