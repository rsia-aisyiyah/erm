<?php

namespace App\Http\Controllers;

use App\Models\ProsedurPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProsedurPasienController extends Controller
{
	private $prosedur;
	protected $track;

	public function __construct()
	{
		$this->prosedur = new ProsedurPasien();
		$this->track = new TrackerSqlController();
	}

	public function ambil(Request $request)
	{
		$prosedur = $this->prosedur->with('icd9')->where('no_rawat', $request->no_rawat)->get();

		return response()->json($prosedur);
	}

	public function tambah(Request $request)
	{
		$prosedur = $this->prosedur->create([
			'no_rawat' => $request->no_rawat,
			'kode' => $request->kode,
			'status' => $request->status,
			'prioritas' => $request->prioritas,
		]);

		return response()->json($prosedur);
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

	public function hapus(Request $request)
	{
		try {
			$prosedur = $this->prosedur->where('no_rawat', $request->no_rawat);
			$key = ['no_rawat' => $request->no_rawat];
			if ($request->kode) {
				$key['kode'] = $request->kode;
				$prosedur = $prosedur->where('kd_penyakit', $request->kode);
			}

			$prosedur = $prosedur->delete();
			if ($prosedur) {
				$this->track->deleteSql($this->prosedur, $key);
			}
		} catch (\Exception $e) {
			return response($e->getMessage(), 500);
		}

		return response()->json('Deleted');
	}
}
