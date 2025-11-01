<?php

namespace App\Action;

use App\Models\JenisPerawatan;
use App\Models\Jurnal;
use App\Models\JurnalDetail;
use App\Models\TindakanDokter;

//use App\Traits\Track;
use App\Models\TindakanDokterPerawat;
use App\Models\TindakanPerawat;
use App\Services\JurnalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;

class TindakanDokterPerawatAction
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

				$tindakan = $this->createTindakanPerawat($data['no_rawat'], $data['nip'], $data['kd_dokter'], $data['tindakan']);
				$this->jurnalService->createJurnalTindakanRalan($data, $tindakan['totals']);
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
				$this->jurnalService->revertJurnalTindakanRalan($data, $tindakan);

			} catch (Exception $e) {
				DB::rollBack();
				throw new Exception($e->getMessage());
			}
		});
		return $tindakan;
	}

	function createTindakanPerawat(string $no_rawat, string $nip, string $kd_dokter, array $data)
	{
		$totals = [
			'ttldokter' => 0,
			'ttlperawat' => 0,
			'ttlkso' => 0,
			'ttlpendapatan' => 0,
			'ttlmaterial' => 0,
			'ttlbhp' => 0,
			'ttlmenejemen' => 0,
		];

		$data = collect($data)->map(function ($item) use ($no_rawat, $nip, $kd_dokter, &$totals) {
			$pendapatan = floatval($item['total_byrdrpr']);
			$totals['ttldokter'] += floatval($item['tarif_tindakandr']);
			$totals['ttlperawat'] += floatval($item['tarif_tindakanpr']);
			$totals['ttlkso'] += floatval($item['kso']);
			$totals['ttlpendapatan'] += floatval($pendapatan);
			$totals['ttlmaterial'] += floatval($item['material']);
			$totals['ttlbhp'] += floatval($item['bhp']);
			$totals['ttlmenejemen'] += floatval($item['menejemen']);


			return [
				'no_rawat' => $no_rawat,
				'nip' => $nip,
				'kd_dokter' => $kd_dokter,
				'kd_jenis_prw' => $item['kd_jenis_prw'],
				'tgl_perawatan' => date('Y-m-d'),
				'jam_rawat' => date('H:i:s'),
				'material' => $item['material'],
				'bhp' => $item['bhp'],
				'tarif_tindakanpr' => $item['tarif_tindakanpr'],
				'kso' => $item['kso'],
				'menejemen' => $item['menejemen'],
				'stts_bayar' => 'Belum',
				'biaya_rawat' => $pendapatan,
			];
		})->toArray();

		$create = DB::table('rawat_jl_drpr')->insert($data);
		return ['data' => $data, 'totals' => $totals];
	}


	protected function deleteTindakanPerawat(array $data): array
	{

		try {
			$totals = [
				'ttlperawat' => 0,
				'ttldokter' => 0,
				'ttlkso' => 0,
				'ttlpendapatan' => 0,
				'ttlmaterial' => 0,
				'ttlbhp' => 0,
				'ttlmenejemen' => 0,
			];
			foreach ($data['tindakan'] as $item) {
				$tindakan = TindakanDokterPerawat::where([
					'no_rawat' => $data['no_rawat'],
					'nip' => $data['nip'],
					'kd_dokter' => $data['kd_dokter'],
					'kd_jenis_prw' => $item['kd_jenis_prw'],
				]);

				$row = $tindakan->first();

				$totals['ttlperawat'] += floatval($row->tarif_tindakanpr);
				$totals['ttldokter'] += floatval($row->tarif_tindakandr);
				$totals['ttlkso'] += floatval($row->kso);
				$totals['ttlpendapatan'] += floatval($row->biaya_rawat);
				$totals['ttlmaterial'] += floatval($row->material);
				$totals['ttlbhp'] += floatval($row->bhp);
				$totals['ttlmenejemen'] += floatval($row->menejemen);
				$delete = $tindakan->delete();

//				if ($delete) {
//					$this->deleteSql(new TindakanDokter(), [
//						'no_rawat' => $row->no_rawat,
//						'nip' => $row->nip,
//						'kd_jenis_prw' => $row->kd_jenis_prw,
//					]);
//				}
			}

			return $totals;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request " . $e->getMessage());
		}
	}


}
