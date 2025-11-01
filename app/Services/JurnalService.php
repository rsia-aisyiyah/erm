<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class JurnalService
{

	public function createJurnalTindakanRalan(array $data, array $totals): void
	{
		$rekening = $this->getRekeningMapping();
		$this->createTampJurnal($rekening, $totals);
		$this->writeOnJurnal($data);
	}

	public function revertJurnalTindakanRalan(array $data, array $totals): void
	{
		$rekening = $this->getRekeningMapping();
		$this->createTampJurnal($rekening, $totals, true);
		$this->writeOnJurnal($data, true);
	}
	public function writeOnJurnal(array $data, bool $isRevert = false)
	{

		$keterangan = $isRevert ? 'PEMBATALAN TINDAKAN RAWAT JALAN ' : 'TINDAKAN RAWAT JALAN ';

		$dataJurnal = [
			'no_jurnal' => $this->generateNoJurnal(),
			'tgl_jurnal' => date('Y-m-d'),
			'jam_jurnal' => date('H:i:s'),
			'no_bukti' => $data['no_rawat'],
			'jenis' => 'U',
			'keterangan' => $keterangan.$data['no_rkm_medis'].' '.$data['nm_pasien'].' DI POST OLEH  '.session()->get('pegawai')->nama,
		];
		DB::table('jurnal')->insert($dataJurnal);
		$this->createDetailJurnal($dataJurnal['no_jurnal']);
	}

	public function createDetailJurnal($no_jurnal)
	{
		try {
			$data = DB::table('tampjurnal')->get();
			if ($data === null) {
				throw new \Exception('Tampjurnal table is empty');
			}
			$data = $data->map(function ($item) use ($no_jurnal) {
				return (array) [
					'no_jurnal' => $no_jurnal,
					'kd_rek' => $item->kd_rek,
					'debet' => $item->debet,
					'kredit' => $item->kredit,
				];
			})->toArray();
			if (empty($data)) {
				throw new \Exception('Tampjurnal table is empty');
			}
			DB::table('detailjurnal')->insert($data);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function generateNoJurnal() : string
	{
		$date = date('Y-m-d');
		$count = DB::table('jurnal')->whereDate('tgl_jurnal', $date)->count();
		$count += 1;
		return 'JR'.date('Ymd').str_pad($count, 6, '0', STR_PAD_LEFT);

	}

	private function createTampJurnal($rekening, $totals, $reverse = false)
	{
		DB::table('tampjurnal')->delete();

		$insertJurnal = function ($kd, $nm, $debet, $kredit) use ($reverse) {
			if ($reverse) {
				[$debet, $kredit] = [$kredit, $debet]; // tukar posisi
			}

			DB::table('tampjurnal')->insert([
				'kd_rek' => $kd,
				'nm_rek' => $nm,
				'debet' => $debet,
				'kredit' => $kredit,
			]);
		};

		if ($totals['ttlpendapatan'] > 0) {
			$insertJurnal($rekening->Suspen_Piutang_Tindakan_Ralan, 'Suspen Piutang Tindakan Ralan', $totals['ttlpendapatan'], 0);
			$insertJurnal($rekening->Tindakan_Ralan, 'Pendapatan Tindakan Rawat Jalan', 0, $totals['ttlpendapatan']);
		}

		if (isset($totals['ttldokter']) && $totals['ttldokter'] > 0) {
			$insertJurnal($rekening->Beban_Jasa_Medik_Dokter_Tindakan_Ralan, 'Beban Jasa Medik Dokter Tindakan Ralan', $totals['ttldokter'], 0);
			$insertJurnal($rekening->Utang_Jasa_Medik_Dokter_Tindakan_Ralan, 'Utang Jasa Medik Dokter Tindakan Ralan', 0, $totals['ttldokter']);
		}
		if (isset($totals['ttlperawat']) && $totals['ttlperawat'] > 0) {
			$insertJurnal($rekening->Beban_Jasa_Medik_Paramedis_Tindakan_Ralan, 'Beban Jasa Medik Paramedis Tindakan Ralan', $totals['ttlperawat'], 0);
			$insertJurnal($rekening->Utang_Jasa_Medik_Paramedis_Tindakan_Ralan, 'Utang Jasa Medik Paramedis Tindakan Ralan', 0, $totals['ttlperawat']);
		}

		if ($totals['ttlkso'] > 0) {
			$insertJurnal($rekening->Beban_KSO_Tindakan_Ralan, 'Beban KSO Tindakan Ralan', $totals['ttlkso'], 0);
			$insertJurnal($rekening->Utang_KSO_Tindakan_Ralan, 'Utang KSO Tindakan Ralan', 0, $totals['ttlkso']);
		}

		if ($totals['ttlmaterial'] > 0) {
			$insertJurnal($rekening->Beban_Jasa_Sarana_Tindakan_Ralan, 'Beban Jasa Sarana Tindakan Ralan', $totals['ttlmaterial'], 0);
			$insertJurnal($rekening->Utang_Jasa_Sarana_Tindakan_Ralan, 'Utang Jasa Sarana Tindakan Ralan', 0, $totals['ttlmaterial']);
		}

		if ($totals['ttlbhp'] > 0) {
			$insertJurnal($rekening->HPP_BHP_Tindakan_Ralan, 'HPP BHP Tindakan Ralan', $totals['ttlbhp'], 0);
			$insertJurnal($rekening->Persediaan_BHP_Tindakan_Ralan, 'Persediaan BHP Tindakan Ralan', 0, $totals['ttlbhp']);
		}

		if ($totals['ttlmenejemen'] > 0) {
			$insertJurnal($rekening->Beban_Jasa_Menejemen_Tindakan_Ralan, 'Beban Jasa Menejemen Tindakan Ralan', $totals['ttlmenejemen'], 0);
			$insertJurnal($rekening->Utang_Jasa_Menejemen_Tindakan_Ralan, 'Utang Jasa Menejemen Tindakan Ralan', 0, $totals['ttlmenejemen']);
		}
	}

	private function getRekeningMapping()
	{
		$rekening = DB::table('set_akun_ralan')
			->first();
		return (object) [
			'Suspen_Piutang_Tindakan_Ralan' => $rekening->Suspen_Piutang_Tindakan_Ralan,
			'Tindakan_Ralan' => $rekening->Tindakan_Ralan,
			'Beban_Jasa_Medik_Dokter_Tindakan_Ralan' => $rekening->Beban_Jasa_Medik_Dokter_Tindakan_Ralan,
			'Utang_Jasa_Medik_Dokter_Tindakan_Ralan' => $rekening->Utang_Jasa_Medik_Dokter_Tindakan_Ralan,
			'Beban_Jasa_Medik_Paramedis_Tindakan_Ralan' => $rekening->Beban_Jasa_Medik_Paramedis_Tindakan_Ralan,
			'Utang_Jasa_Medik_Paramedis_Tindakan_Ralan' => $rekening->Utang_Jasa_Medik_Paramedis_Tindakan_Ralan,
			'Beban_KSO_Tindakan_Ralan' => $rekening->Beban_KSO_Tindakan_Ralan,
			'Utang_KSO_Tindakan_Ralan' => $rekening->Utang_KSO_Tindakan_Ralan,
			'Beban_Jasa_Sarana_Tindakan_Ralan' => $rekening->Beban_Jasa_Sarana_Tindakan_Ralan,
			'Utang_Jasa_Sarana_Tindakan_Ralan' => $rekening->Utang_Jasa_Sarana_Tindakan_Ralan,
			'Beban_Jasa_Menejemen_Tindakan_Ralan' => $rekening->Beban_Jasa_Menejemen_Tindakan_Ralan,
			'Utang_Jasa_Menejemen_Tindakan_Ralan' => $rekening->Utang_Jasa_Menejemen_Tindakan_Ralan,
			'HPP_BHP_Tindakan_Ralan' => $rekening->HPP_BHP_Tindakan_Ralan,
			'Persediaan_BHP_Tindakan_Ralan' => $rekening->Persediaan_BHP_Tindakan_Ralan,
		];

	}
}