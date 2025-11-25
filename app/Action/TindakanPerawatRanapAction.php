<?php

namespace App\Action;

use App\Models\JenisPerawatan;
use App\Models\Jurnal;
use App\Models\JurnalDetail;
use App\Models\TindakanDokter;

//use App\Traits\Track;
use App\Models\TindakanDokterPerawat;
use App\Models\TindakanDokterRanap;
use App\Models\TindakanPerawat;
use App\Models\TindakanPerawatRanap;
use App\Services\JurnalService;
use Illuminate\Support\Facades\DB;
use Exception;

class TindakanPerawatRanapAction
{

	protected JurnalService $jurnalService;

	public function __construct(JurnalService $jurnalService)
	{
		$this->jurnalService = $jurnalService;
	}

	public function handleCreate(array $data): array
	{
		$tindakan = [];
		try {
			DB::transaction(function () use ($data, &$tindakan) {

				$tindakan = $this->createTindakanPerawat($data['no_rawat'], $data['nip'], $data['tindakan']);
				$this->jurnalService->createJurnalTindakan($data, $tindakan['totals'], 'ranap');
			});
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
		return $tindakan;
	}

	public function handleDelete(array $data): array
	{
		$tindakan = [];

		DB::transaction(function () use ($data, &$tindakan) {
			try {
				$tindakan = $this->deleteTindakanPerawat($data);
				$this->jurnalService->revertJurnalTindakan($data, $tindakan, 'ranap' );

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		});
		return $tindakan;
	}


	function createTindakanPerawat(string $no_rawat, string $nip, array $data)
	{
		$totals = [
			'ttlperawat' => 0,
			'ttlkso' => 0,
			'ttlpendapatan' => 0,
			'ttlmaterial' => 0,
			'ttlbhp' => 0,
			'ttlmenejemen' => 0,
		];

		$data = collect($data)->map(function ($item) use ($no_rawat, $nip, &$totals) {
			$pendapatan = floatval($item['total_byrpr']);
			$totals['ttlperawat'] += floatval($item['tarif_tindakanpr']);
			$totals['ttlkso'] += floatval($item['kso']);
			$totals['ttlpendapatan'] += floatval($pendapatan);
			$totals['ttlmaterial'] += floatval($item['material']);
			$totals['ttlbhp'] += floatval($item['bhp']);
			$totals['ttlmenejemen'] += floatval($item['menejemen']);


			return [
				'no_rawat' => $no_rawat,
				'nip' => $nip,
				'kd_jenis_prw' => $item['kd_jenis_prw'],
				'tgl_perawatan' => date('Y-m-d'),
				'jam_rawat' => date('H:i:s'),
				'material' => $item['material'],
				'bhp' => $item['bhp'],
				'tarif_tindakanpr' => $item['tarif_tindakanpr'],
				'kso' => $item['kso'],
				'menejemen' => $item['menejemen'],
				'biaya_rawat' => $pendapatan,
			];
		})->toArray();

		$create = DB::table('rawat_inap_pr')->insert($data);
		return ['data' => $data, 'totals' => $totals];
	}


	protected function deleteTindakanPerawat(array $data): array
	{

		try {
			$totals = [
				'ttlperawat' => 0,
				'ttlkso' => 0,
				'ttlpendapatan' => 0,
				'ttlmaterial' => 0,
				'ttlbhp' => 0,
				'ttlmenejemen' => 0,
			];
			foreach ($data['tindakan'] as $item) {
				$tindakan = TindakanPerawatRanap::where([
					'no_rawat' => $data['no_rawat'],
					'nip' => $item['nip'],
					'kd_jenis_prw' => $item['kd_jenis_prw'],
				]);

				$row = $tindakan->first();

				$totals['ttlperawat'] += floatval($row->tarif_tindakanpr);
				$totals['ttlkso'] += floatval($row->kso);
				$totals['ttlpendapatan'] += floatval($row->biaya_rawat);
				$totals['ttlmaterial'] += floatval($row->material);
				$totals['ttlbhp'] += floatval($row->bhp);
				$totals['ttlmenejemen'] += floatval($row->menejemen);
				$delete = $tindakan->delete();
			}

			return $totals;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request " . $e->getMessage());
		}
	}

}
