<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class JurnalService
{
	public function createJurnalTindakan(array $data, array $totals, string $jenis = 'ralan'): void
	{
		$rekening = $this->getRekeningMapping($jenis);
		$this->createTampJurnal($rekening, $totals, false, $jenis);
		$this->writeOnJurnal($data, false, $jenis);
	}

	public function revertJurnalTindakan(array $data, array $totals, string $jenis = 'ralan'): void
	{
		$rekening = $this->getRekeningMapping($jenis);
		$this->createTampJurnal($rekening, $totals, true, $jenis);
		$this->writeOnJurnal($data, true, $jenis);
	}

	public function writeOnJurnal(array $data, bool $isRevert = false, string $jenis = 'ralan')
	{
		$namaJenis = strtoupper($jenis === 'ralan' ? 'RAWAT JALAN' : 'RAWAT INAP');
		$keterangan = $isRevert ? "PEMBATALAN TINDAKAN $namaJenis " : "TINDAKAN $namaJenis ";

		$dataJurnal = [
			'no_jurnal' => $this->generateNoJurnal(),
			'tgl_jurnal' => date('Y-m-d'),
			'jam_jurnal' => date('H:i:s'),
			'no_bukti' => $data['no_rawat'],
			'jenis' => 'U',
			'keterangan' => $keterangan . $data['no_rkm_medis'] . ' ' . $data['nm_pasien'] . ' DI POST OLEH ' . session()->get('pegawai')->nama,
		];

		DB::table('jurnal')->insert($dataJurnal);
		$this->createDetailJurnal($dataJurnal['no_jurnal']);
	}

	public function createDetailJurnal($no_jurnal)
	{
		try {
			$data = DB::table('tampjurnal')->get();
			if ($data->isEmpty()) {
				throw new \Exception('Tampjurnal table is empty');
			}

			$records = $data->map(function ($item) use ($no_jurnal) {
				return [
					'no_jurnal' => $no_jurnal,
					'kd_rek' => $item->kd_rek,
					'debet' => $item->debet,
					'kredit' => $item->kredit,
				];
			})->toArray();

			DB::table('detailjurnal')->insert($records);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function generateNoJurnal(): string
	{
		$date = date('Y-m-d');
		$count = DB::table('jurnal')->whereDate('tgl_jurnal', $date)->count();
		$count++;
		return 'JR' . date('Ymd') . str_pad($count, 6, '0', STR_PAD_LEFT);
	}

	private function createTampJurnal($rekening, $totals, $reverse = false, string $jenis = 'ralan')
	{
		DB::table('tampjurnal')->delete();

		$insertJurnal = function ($kd, $nm, $debet, $kredit) use ($reverse) {
			if ($reverse) {
				[$debet, $kredit] = [$kredit, $debet];
			}

			DB::table('tampjurnal')->insert([
				'kd_rek' => $kd,
				'nm_rek' => $nm,
				'debet' => $debet,
				'kredit' => $kredit,
			]);
		};

		$label = ucfirst($jenis === 'ralan' ? 'Rawat Jalan' : 'Rawat Inap');
		$prefix = ucfirst($jenis); // Ralan / Ranap

		$akunMap = [
			'ttlpendapatan' => [
				["Suspen_Piutang_Tindakan_{$prefix}", "Suspen Piutang Tindakan {$label}"],
				["Tindakan_{$prefix}", "Pendapatan Tindakan {$label}"],
			],
			'ttldokter' => [
				["Beban_Jasa_Medik_Dokter_Tindakan_{$prefix}", "Beban Jasa Medik Dokter Tindakan {$label}"],
				["Utang_Jasa_Medik_Dokter_Tindakan_{$prefix}", "Utang Jasa Medik Dokter Tindakan {$label}"],
			],
			'ttlperawat' => [
				["Beban_Jasa_Medik_Paramedis_Tindakan_{$prefix}", "Beban Jasa Medik Paramedis Tindakan {$label}"],
				["Utang_Jasa_Medik_Paramedis_Tindakan_{$prefix}", "Utang Jasa Medik Paramedis Tindakan {$label}"],
			],
			'ttlkso' => [
				["Beban_KSO_Tindakan_{$prefix}", "Beban KSO Tindakan {$label}"],
				["Utang_KSO_Tindakan_{$prefix}", "Utang KSO Tindakan {$label}"],
			],
			'ttlmaterial' => [
				["Beban_Jasa_Sarana_Tindakan_{$prefix}", "Beban Jasa Sarana Tindakan {$label}"],
				["Utang_Jasa_Sarana_Tindakan_{$prefix}", "Utang Jasa Sarana Tindakan {$label}"],
			],
			'ttlbhp' => [
				["HPP_BHP_Tindakan_{$prefix}", "HPP BHP Tindakan {$label}"],
				["Persediaan_BHP_Tindakan_{$prefix}", "Persediaan BHP Tindakan {$label}"],
			],
			'ttlmenejemen' => [
				["Beban_Jasa_Menejemen_Tindakan_{$prefix}", "Beban Jasa Menejemen Tindakan {$label}"],
				["Utang_Jasa_Menejemen_Tindakan_{$prefix}", "Utang Jasa Menejemen Tindakan {$label}"],
			],
		];

		foreach ($akunMap as $key => $pairs) {
			if (!empty($totals[$key]) && $totals[$key] > 0) {
				[$kd1, $nm1] = $pairs[0];
				[$kd2, $nm2] = $pairs[1];
				$insertJurnal($rekening->$kd1, $nm1, $totals[$key], 0);
				$insertJurnal($rekening->$kd2, $nm2, 0, $totals[$key]);
			}
		}
	}

	private function getRekeningMapping(string $jenis = 'ralan')
	{
		$tabel = $jenis === 'ranap' ? 'set_akun_ranap' : 'set_akun_ralan';
		$prefix = ucfirst($jenis);

		$rekening = DB::table($tabel)->first();

		return (object) [
			"Suspen_Piutang_Tindakan_{$prefix}" => $rekening->{"Suspen_Piutang_Tindakan_{$prefix}"},
			"Tindakan_{$prefix}" => $rekening->{"Tindakan_{$prefix}"},
			"Beban_Jasa_Medik_Dokter_Tindakan_{$prefix}" => $rekening->{"Beban_Jasa_Medik_Dokter_Tindakan_{$prefix}"},
			"Utang_Jasa_Medik_Dokter_Tindakan_{$prefix}" => $rekening->{"Utang_Jasa_Medik_Dokter_Tindakan_{$prefix}"},
			"Beban_Jasa_Medik_Paramedis_Tindakan_{$prefix}" => $rekening->{"Beban_Jasa_Medik_Paramedis_Tindakan_{$prefix}"},
			"Utang_Jasa_Medik_Paramedis_Tindakan_{$prefix}" => $rekening->{"Utang_Jasa_Medik_Paramedis_Tindakan_{$prefix}"},
			"Beban_KSO_Tindakan_{$prefix}" => $rekening->{"Beban_KSO_Tindakan_{$prefix}"},
			"Utang_KSO_Tindakan_{$prefix}" => $rekening->{"Utang_KSO_Tindakan_{$prefix}"},
			"Beban_Jasa_Sarana_Tindakan_{$prefix}" => $rekening->{"Beban_Jasa_Sarana_Tindakan_{$prefix}"},
			"Utang_Jasa_Sarana_Tindakan_{$prefix}" => $rekening->{"Utang_Jasa_Sarana_Tindakan_{$prefix}"},
			"Beban_Jasa_Menejemen_Tindakan_{$prefix}" => $rekening->{"Beban_Jasa_Menejemen_Tindakan_{$prefix}"},
			"Utang_Jasa_Menejemen_Tindakan_{$prefix}" => $rekening->{"Utang_Jasa_Menejemen_Tindakan_{$prefix}"},
			"HPP_BHP_Tindakan_{$prefix}" => $rekening->{"HPP_BHP_Tindakan_{$prefix}"},
			"Persediaan_BHP_Tindakan_{$prefix}" => $rekening->{"Persediaan_BHP_Tindakan_{$prefix}"},
		];
	}
}
