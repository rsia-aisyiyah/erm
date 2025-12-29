<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaanLab;
use App\Models\RegPeriksa;
use App\Services\Lab\LabResultService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPemeriksaanLabController extends Controller
{
	protected DetailPemeriksaanLab $detailPemeriksaanLab;

	/**
	 * Initializes a new instance of the DetailPemeriksaanLabController class.
	 *
	 * @param DetailPemeriksaanLab $detailPemeriksaanLab The DetailPemeriksaanLab instance to be used.
	 * @return void
	 */
	public function __construct(DetailPemeriksaanLab $detailPemeriksaanLab)
	{
		$this->detailPemeriksaanLab = $detailPemeriksaanLab;
	}

	function get(Request $request): JsonResponse
	{
		$data = $this->detailPemeriksaanLab
			->where('no_rawat', $request->no_rawat)
			->with('template')
			->select('no_rawat', 'kd_jenis_prw', 'tgl_periksa', 'jam', 'id_template', 'nilai')
			->get();

		return response()->json($data);
	}

	public function history(string $no_rkm_medis)
	{
		$labService = app(LabResultService::class);

		$data = $this->detailPemeriksaanLab
			->whereHas('regPeriksa', fn ($q) =>
			$q->where('no_rkm_medis', $no_rkm_medis)
			)
			->select(['no_rawat', 'kd_jenis_prw', 'tgl_periksa', 'jam', 'nilai', 'nilai_rujukan'])
			->whereIn('kd_jenis_prw', $labService->riskTestCodes())
			->with([
				'regPeriksa:no_rawat,no_rkm_medis,tgl_registrasi,jam_reg,kd_poli',
				'jnsPerawatanLab:kd_jenis_prw,nm_perawatan'
			])
			->orderByDesc('tgl_periksa')
			->orderByDesc('jam')
			->get();

		$infectionAlert = $labService->evaluate($data);

		return response()->json([
			'data' => $data,
			'infection_alert' => $infectionAlert,
		]);
	}

}
