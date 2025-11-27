<?php

namespace App\Action;

use App\Models\JenisPerawatan;
use App\Models\Jurnal;
use App\Models\JurnalDetail;
use App\Models\TindakanDokter;

//use App\Traits\Track;
use App\Models\TindakanDokterRanap;
use App\Services\JurnalService;
use Illuminate\Support\Facades\DB;
use Exception;

class TindakanDokterRanapAction
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

				$tindakan = $this->createTindakanDokter($data['no_rawat'], $data['kd_dokter'], $data['tindakan']);
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
				$tindakan = $this->deleteTindakanDokter($data);
				$this->jurnalService->revertJurnalTindakan($data, $tindakan, 'ranap' );

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		});
		return $tindakan;
	}

	function createTindakanDokter(string $no_rawat, string $kd_dokter, array $data)
	{
		$totals = [
			'ttldokter' => 0,
			'ttlkso' => 0,
			'ttlpendapatan' => 0,
			'ttlmaterial' => 0,
			'ttlbhp' => 0,
			'ttlmenejemen' => 0,
		];

		$data = collect($data)->map(function ($item) use ($no_rawat, $kd_dokter, &$totals) {
			$pendapatan = floatval($item['total_byrdr']);
			$totals['ttldokter'] += floatval($item['tarif_tindakandr']);
			$totals['ttlkso'] += floatval($item['kso']);
			$totals['ttlpendapatan'] += floatval($pendapatan);
			$totals['ttlmaterial'] += floatval($item['material']);
			$totals['ttlbhp'] += floatval($item['bhp']);
			$totals['ttlmenejemen'] += floatval($item['menejemen']);

			return [
				'no_rawat' => $no_rawat,
				'kd_dokter' => $kd_dokter,
				'kd_jenis_prw' => $item['kd_jenis_prw'],
				'tgl_perawatan' => date('Y-m-d'),
				'jam_rawat' => date('H:i:s'),
				'material' => $item['material'],
				'bhp' => $item['bhp'],
				'tarif_tindakandr' => $item['tarif_tindakandr'],
				'kso' => $item['kso'],
				'menejemen' => $item['menejemen'],
				'biaya_rawat' => $pendapatan,
			];
		})->toArray();

		$create = DB::table('rawat_inap_dr')->insert($data);
		return ['data' => $data, 'totals' => $totals];
	}
	protected function deleteTindakanDokter(array $data): array
	{
		try {

			$totals = [
				'ttldokter' => 0,
				'ttlkso' => 0,
				'ttlpendapatan' => 0,
				'ttlmaterial' => 0,
				'ttlbhp' => 0,
				'ttlmenejemen' => 0,
			];

			foreach ($data['tindakan'] as $item) {
				$tindakan = TindakanDokterRanap::where([
					'no_rawat' => $data['no_rawat'],
					'kd_dokter' => $item['kd_dokter'],
					'kd_jenis_prw' => $item['kd_jenis_prw'],
				]);

				$row = $tindakan->first();

				$totals['ttldokter'] += floatval($row->tarif_tindakandr);
				$totals['ttlkso'] += floatval($row->kso);
				$totals['ttlpendapatan'] += floatval($row->biaya_rawat);
				$totals['ttlmaterial'] += floatval($row->material);
				$totals['ttlbhp'] += floatval($row->bhp);
				$totals['ttlmenejemen'] += floatval($row->menejemen);
				$delete = $tindakan->delete();
			}

			return $totals;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
		}
	}


}
