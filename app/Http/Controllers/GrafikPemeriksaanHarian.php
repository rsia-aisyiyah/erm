<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\GrafikHarian;

class GrafikPemeriksaanHarian extends Controller
{
	protected $grafik;
	protected $track;

	public function __construct()
	{
		$this->grafik = new GrafikHarian();
		$this->track = new TrackerSqlController();
	}

	public function create(Request $request) : JsonResponse
	{
		$data = [
			'nip' => $request->nip,
			'no_rawat' => $request->no_rawat,
			'suhu_tubuh' => $request->suhu_tubuh,
			'tensi' => $request->tensi,
			'respirasi' => $request->respirasi,
			'nadi' => $request->nadi,
			'spo2' => $request->spo2,
			'gcs' => $request->gcs,
			'kesadaran' => $request->kesadaran,
			'keluaran_urin' => $request->keluaran_urin,
			'proteinuria' => $request->proteinuria,
			'air_ketuban' => $request->air_ketuban,
			'skala_nyeri' => $request->skala_nyeri,
			'lochia' => $request->lochia,
			'terlihat_tidak_sehat' => $request->terlihat_tidak_sehat,
			'o2' => $request->o2,
			'sumber' => 'SOAP',
			'jam_rawat' => date('H:i:s'),
			'tgl_perawatan' => date('Y-m-d'),
		];

		try {
			$create = $this->grafik->create($data);
			if($create){
				$this->track->insertSql($this->grafik, $data);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}

		return response()->json('SUKES');

	}

	public function update(Request $request){
		$clause = ['no_rawat' => $request->no_rawat, 'tgl_perawatan' => $request->tgl_perawatan, 'jam_rawat' => $request->jam_rawat];
		$data = $request->all();
		try {
			$grafik = $this->grafik->where($clause)->update($data);
			if($grafik){
				$this->track->updateSql($this->grafik, $request, $clause);
			}
		}catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
			return response()->json('SUKSES');
	}


}
