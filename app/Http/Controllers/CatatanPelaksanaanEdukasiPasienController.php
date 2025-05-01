<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelaksanaanEdukasiPasien;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatatanPelaksanaanEdukasiPasienController extends Controller
{
	protected $catatan;
	protected $track;

	public function __construct(CatatanPelaksanaanEdukasiPasien $catatan)
	{
		$this->catatan = $catatan;
		$this->track = new TrackerSqlController();
	}

	public function get(Request $request): JsonResponse
	{
		$catatan = $this->catatan->with(['pasien', 'regPeriksa', 'dokter', 'petugas']);
		if ($request->tanggal) {
			$query = $catatan->where('no_rawat', $request->no_rawat)
				->where('tanggal', $request->tanggal)->first();
		} else {
			$query = $catatan->where('no_rawat', $request->no_rawat)->get();
		}

		return response()->json($query);
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'materi' => 'required',
			'tanggal' => 'required',
			'nip' => 'required',
			'metode' => 'required',
			'evaluasi' => 'required',
			'hambatan_lain' => 'nullable',
			'intervensi_lain' => 'nullable',
			'hambatan' => 'nullable',
			'intervensi' => 'nullable',
		]);
		$isExist = $this->catatan->where([
			'no_rawat' => $data['no_rawat'],
			'tanggal' => $data['tanggal']
		])->count();

		if ($isExist) {
			return $this->update($request);
		}

		try {
			$query = $this->catatan->insert($data);
			if ($query) {
				$this->track->insertSql($this->catatan, $data);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo);

		}
		return response()->json('Berhasil menambah catatan edukasi pasien');

	}

	protected function update(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'materi' => 'required',
			'tanggal' => 'required',
			'nip' => 'required',
			'metode' => 'required',
			'evaluasi' => 'required',
			'hambatan_lain' => 'nullable',
			'intervensi_lain' => 'nullable',
			'hambatan' => 'nullable',
			'intervensi' => 'nullable',
		]);

		try {
			$clause = [
				'no_rawat' => $data['no_rawat'],
				'tanggal' => $data['tanggal']
			];
			$query = $this->catatan->where($clause)->update($data);
			if ($query) {
				$this->track->updateSql($this->catatan, $data, $clause);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo);
		}

		return response()->json('Berhasil mengubah catatan edukasi pasien');
	}

	function delete(Request $request)
	{
		$clause = [
			'no_rawat' => $request->no_rawat,
			'tanggal' => $request->tanggal,
			'nip' => $request->nip
		];
		try {
			$query = $this->catatan->where($clause)->delete();
			if($query){
				$this->track->deleteSql($this->catatan, $clause);
			}
		}catch (QueryException $e){
			return response()->json($e->errorInfo);
		}

		return response()->json('Berhasil menghapus catatan edukasi pasien');
	}
}
