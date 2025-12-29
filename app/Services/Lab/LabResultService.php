<?php

namespace App\Services\Lab;

class LabResultService
{
	/**
	 * ===========================
	 * 1️⃣ RISIKO BERBASIS KODE
	 * ===========================
	 */
	protected array $riskMapping = [

		'high' => [
			// HIV
			'J000015', // HIV
			'J000031', // HIV 2

			// Hepatitis
			'J000012', // HBsAg

			// Sifilis
			'J000032', // Syphilis
			'J000016', // Syphilis 1
			'J000069', // VDRL
			'J000070', // TPHA

			// TB
			'J000082', // Sputum pagi (TCM)
			'J000083', // Putum sewaktu (TCM)
			'J000080', // Tes Mantoux

			// Covid
			'J000049', // Covid-19 Rapid Antigen
			'J000037', // Rapid Test Serologi Covid-19
		],


//		'moderate' => [
//			// Gastro / feses
//			'J000045', // Feses
//			'J000044', // Fases Rutin
//			'J000036', // Feses Rutin
//
//			// Kultur & swab
//			'J000063', // Kultur Urine
//			'J000065', // Swab Rectal
//
//			// Dengue & tifoid
//			'J000004', // IgM / IgG Dengue
//			'J000071', // NS1Ag
//			'J00005',  // IgM Salmonela Typhi
//			'J000064', // Rapid Salmonela Typhi
//			'J000060', // Widal
//			'J000061', // Widal
//
//			// TORCH / CMV
//			'J000038', // Imunoserologi CMV
//		],
	];

	/**
	 * ===========================
	 * 2️⃣ KEYWORD HASIL
	 * ===========================
	 */
	protected array $positiveKeywords = [
		'positif', 'positive',
		'reaktif', 'reactive',
		'detected',
		'(+)',
	];

	protected array $negativeKeywords = [
		'negatif', 'negative',
		'non reaktif', 'nonreaktif',
		'tidak terdeteksi',
		'undetected',
		'(-)',
	];

	/**
	 * ===========================
	 * 3️⃣ API UTAMA
	 * ===========================
	 */
	public function evaluate(iterable $labResults): array
	{
		$alerts = [];

		foreach ($labResults as $row) {

			$nilai = $row->nilai ?? '';

			// ⛔ NEGATIVE harus dicek lebih dulu
			if ($this->isNegative($nilai)) {
				continue;
			}

			// ✅ Lolos negative → cek positive
			if (! $this->isPositive($nilai)) {
				continue;
			}

			$risk = $this->resolveRiskLevel($row->kd_jenis_prw ?? null);

			if (! $risk) {
				continue;
			}

			$alerts[] = [
				'level'         => strtoupper($risk),
				'kd_jenis_prw'  => $row->kd_jenis_prw,
				'nm_perawatan' => optional($row->jnsPerawatanLab)->nm_perawatan,
				'nilai'         => $nilai,
				'tgl_periksa'   => $row->tgl_periksa,
				'jam'           => $row->jam,
			];
		}

		return [
			'infection_alert' => !empty($alerts),
			'highest_risk'    => $this->highestRisk($alerts),
			'alerts'          => $alerts,
		];
	}

	/**
	 * ===========================
	 * 4️⃣ INTERNAL
	 * ===========================
	 */
	protected function normalize(string $value): string
	{
		return strtolower(trim($value));
	}

	protected function isNegative(string $value): bool
	{
		$value = $this->normalize($value);

		foreach ($this->negativeKeywords as $keyword) {
			if (str_contains($value, $keyword)) {
				return true;
			}
		}

		return false;
	}

	protected function isPositive(string $value): bool
	{
		$value = $this->normalize($value);

		foreach ($this->positiveKeywords as $keyword) {
			if (str_contains($value, $keyword)) {
				return true;
			}
		}

		return false;
	}

	protected function resolveRiskLevel(?string $kdJenisPrw): ?string
	{
		if (! $kdJenisPrw) {
			return null;
		}

		foreach ($this->riskMapping as $level => $codes) {
			if (in_array($kdJenisPrw, $codes, true)) {
				return $level;
			}
		}

		return null;
	}

	protected function highestRisk(array $alerts): ?string
	{
		if (collect($alerts)->contains('level', 'HIGH')) {
			return 'HIGH';
		}

		if (collect($alerts)->contains('level', 'MODERATE')) {
			return 'MODERATE';
		}

		return null;
	}

	/**
	 * 🔑 Untuk query filter di controller
	 */
	public function riskTestCodes(): array
	{
		return array_values(array_unique(
			array_merge(
				$this->riskMapping['high'],
//				$this->riskMapping['moderate']
			)
		));
	}
}
