<?php

namespace App\Http\Controllers;

use App\Models\BuktiPersetujuanTransferPasienAntarRuang;
use App\Models\RegPeriksa;
use App\Models\TransferPasienAntarRuang;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDF;

class TransferPasienAntarRuangController extends Controller
{
	protected $transfer;
	protected $bukti;
	protected $track;

	public function __construct(TransferPasienAntarRuang $transfer, BuktiPersetujuanTransferPasienAntarRuang $bukti)
	{
		$this->transfer = $transfer;
		$this->bukti = $bukti;
		$this->track = new TrackerSqlController();
	}

	protected function parseDateTime(?string $dateTime): ?string
	{
		if (empty($dateTime)) {
			return null;
		}
		try {
			return \Carbon\Carbon::parse($dateTime)->format('Y-m-d H:i:s');
		} catch (\Throwable $e) {
			return $dateTime;
		}
	}

	public function get(Request $request): JsonResponse
	{
		$query = $this->transfer->with([
			'regPeriksa.pasien',
			'regPeriksa.kamarInap.kamar.bangsal',
			'petugasMenyerahkan',
			'pegawaiMenyerahkan',
			'petugasMenerima',
			'pegawaiMenerima',
			'bukti'
		]);

		if ($request->no_rawat && $request->tanggal_masuk) {
			$tglMasuk = $this->parseDateTime($request->tanggal_masuk);
			$data = $query->where('no_rawat', $request->no_rawat)
				->where('tanggal_masuk', $tglMasuk)
				->first();
		} elseif ($request->no_rawat) {
			$data = $query->where('no_rawat', $request->no_rawat)
				->orderBy('tanggal_pindah', 'desc')
				->get();
		} else {
			$data = $query->orderBy('tanggal_pindah', 'desc')->limit(100)->get();
		}

		return response()->json($data);
	}

	protected function handleSignature(string $noRawat, string $tglMasuk, ?string $signatureData): ?string
	{
		if (empty($signatureData)) {
			return null;
		}

		// Jika sudah merupakan path file tersimpan, pertahankan
		if (!str_starts_with($signatureData, 'data:image')) {
			return $signatureData;
		}

		@list($type, $data) = explode(';', $signatureData);
		@list(, $data) = explode(',', $data);

		if (empty($data)) {
			return null;
		}

		$binary = base64_decode($data);
		if ($binary === false) {
			return null;
		}

		$cleanNoRawat = str_replace(['/', ' '], ['-', '_'], $noRawat);
		$cleanTgl = str_replace(['-', ':', ' '], '', $tglMasuk);
		$folder = 'signatures/transfer_pasien';

		if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($folder)) {
			\Illuminate\Support\Facades\Storage::disk('public')->makeDirectory($folder);
		}

		$fileName = 'ttd_transfer_' . $cleanNoRawat . '_' . $cleanTgl . '.png';
		$filePath = $folder . '/' . $fileName;

		\Illuminate\Support\Facades\Storage::disk('public')->put($filePath, $binary);

		return $filePath;
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'tanggal_masuk' => 'required',
			'tanggal_pindah' => 'required',
			'asal_ruang' => 'nullable',
			'ruang_selanjutnya' => 'nullable',
			'diagnosa_utama' => 'nullable',
			'diagnosa_sekunder' => 'nullable',
			'indikasi_pindah_ruang' => 'nullable',
			'keterangan_indikasi_pindah_ruang' => 'nullable',
			'prosedur_yang_sudah_dilakukan' => 'nullable',
			'obat_yang_telah_diberikan' => 'nullable',
			'metode_pemindahan_pasien' => 'nullable',
			'peralatan_yang_menyertai' => 'nullable',
			'keterangan_peralatan_yang_menyertai' => 'nullable',
			'pemeriksaan_penunjang_yang_dilakukan' => 'nullable',
			'pasien_keluarga_menyetujui' => 'nullable',
			'nama_menyetujui' => 'nullable',
			'hubungan_menyetujui' => 'nullable',
			'keluhan_utama_sebelum_transfer' => 'nullable',
			'keadaan_umum_sebelum_transfer' => 'nullable',
			'td_sebelum_transfer' => 'nullable',
			'nadi_sebelum_transfer' => 'nullable',
			'rr_sebelum_transfer' => 'nullable',
			'suhu_sebelum_transfer' => 'nullable',
			'keluhan_utama_sesudah_transfer' => 'nullable',
			'keadaan_umum_sesudah_transfer' => 'nullable',
			'td_sesudah_transfer' => 'nullable',
			'nadi_sesudah_transfer' => 'nullable',
			'rr_sesudah_transfer' => 'nullable',
			'suhu_sesudah_transfer' => 'nullable',
			'nip_menyerahkan' => 'required',
			'nip_menerima' => 'required',
		]);

		// Parse & format tanggal ke format SQL YYYY-MM-DD HH:mm:ss untuk mencegah nilai 0000-00-00 00:00:00
		$data['tanggal_masuk'] = $this->parseDateTime($data['tanggal_masuk']);
		$data['tanggal_pindah'] = $this->parseDateTime($data['tanggal_pindah']);

		// Pastikan nip_menyerahkan dan nip_menerima valid di tabel petugas (mencegah foreign key failure)
		if (!\App\Models\Petugas::where('nip', $data['nip_menyerahkan'])->exists()) {
			$defPetugas = \App\Models\Petugas::first();
			if ($defPetugas) {
				$data['nip_menyerahkan'] = $defPetugas->nip;
			}
		}
		if (!\App\Models\Petugas::where('nip', $data['nip_menerima'])->exists()) {
			$defPetugas = \App\Models\Petugas::first();
			if ($defPetugas) {
				$data['nip_menerima'] = $defPetugas->nip;
			}
		}

		$clause = [
			'no_rawat' => $data['no_rawat'],
			'tanggal_masuk' => $data['tanggal_masuk'],
		];

		$isExist = $this->transfer->where($clause)->count();

		try {
			if ($isExist) {
				$query = $this->transfer->where($clause)->update($data);
				try {
					$this->track->updateSql($this->transfer, $data, $clause);
				} catch (\Throwable $t) {
					// ignore tracker error
				}
				$pesan = 'Berhasil memperbarui data transfer pasien antar ruang';
			} else {
				$query = $this->transfer->insert($data);
				try {
					$this->track->insertSql($this->transfer, $data);
				} catch (\Throwable $t) {
					// ignore tracker error
				}
				$pesan = 'Berhasil menyimpan data transfer pasien antar ruang';
			}

			// Simpan / update tanda tangan sebagai file gambar di storage
			if ($request->has('photo') && !empty($request->photo)) {
				$savedPath = $this->handleSignature($data['no_rawat'], $data['tanggal_masuk'], $request->photo);
				if ($savedPath) {
					$buktiExist = $this->bukti->where($clause)->count();
					if ($buktiExist) {
						$this->bukti->where($clause)->update(['photo' => $savedPath]);
					} else {
						$this->bukti->insert([
							'no_rawat' => $data['no_rawat'],
							'tanggal_masuk' => $data['tanggal_masuk'],
							'photo' => $savedPath,
						]);
					}
				}
			}

			return response()->json($pesan);
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
	}

	public function delete(Request $request): JsonResponse
	{
		$request->validate([
			'no_rawat' => 'required',
			'tanggal_masuk' => 'required',
		]);

		$tglMasuk = $this->parseDateTime($request->tanggal_masuk);
		$clause = [
			'no_rawat' => $request->no_rawat,
			'tanggal_masuk' => $tglMasuk,
		];

		try {
			$bukti = $this->bukti->where($clause)->first();
			if ($bukti && !empty($bukti->photo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($bukti->photo)) {
				\Illuminate\Support\Facades\Storage::disk('public')->delete($bukti->photo);
			}

			$this->transfer->where($clause)->delete();
			$this->bukti->where($clause)->delete();
			try {
				$this->track->deleteSql($this->transfer, $clause);
			} catch (\Throwable $t) {
				// ignore tracker error
			}
			return response()->json('Berhasil menghapus data transfer pasien');
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
	}

	public function print(Request $request)
	{
		$noRawat = $request->no_rawat;
		if (!$noRawat) {
			return response()->json(['message' => 'No rawat tidak valid'], 400);
		}

		$cleanNoRawat = str_replace('-', '/', $noRawat);

		$regPeriksa = RegPeriksa::with([
			'pasien',
			'kamarInap.kamar.bangsal',
			'dokter',
			'poliklinik'
		])->where('no_rawat', $cleanNoRawat)->first();

		if (!$regPeriksa) {
			return response()->json(['message' => 'Data registrasi tidak ditemukan'], 404);
		}

		$query = TransferPasienAntarRuang::with([
			'petugasMenyerahkan',
			'pegawaiMenyerahkan',
			'petugasMenerima',
			'pegawaiMenerima',
			'bukti'
		])->where('no_rawat', $cleanNoRawat);

		if ($request->tanggal_masuk) {
			$tglMasuk = $this->parseDateTime($request->tanggal_masuk);
			$transfer = $query->where('tanggal_masuk', $tglMasuk)->first();
		} else {
			$transfer = $query->orderBy('tanggal_pindah', 'desc')->first();
		}

		if (!$transfer) {
			return response()->json(['message' => 'Data transfer pasien tidak ditemukan'], 404);
		}

		$pdf = PDF::loadView('content.print.transfer_pasien_antar_ruang', [
			'regPeriksa' => $regPeriksa,
			'transfer' => $transfer,
		])->setPaper('A4', 'portrait');

		return $pdf->stream('Transfer_Pasien_' . str_replace('/', '_', $cleanNoRawat) . '.pdf');
	}
}
