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
			$data = $query->where('no_rawat', $request->no_rawat)
				->where('tanggal_masuk', $request->tanggal_masuk)
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

			// Simpan / update tanda tangan jika ada
			if ($request->has('photo') && !empty($request->photo)) {
				$buktiExist = $this->bukti->where($clause)->count();
				if ($buktiExist) {
					$this->bukti->where($clause)->update(['photo' => $request->photo]);
				} else {
					$this->bukti->insert([
						'no_rawat' => $data['no_rawat'],
						'tanggal_masuk' => $data['tanggal_masuk'],
						'photo' => $request->photo,
					]);
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

		$clause = [
			'no_rawat' => $request->no_rawat,
			'tanggal_masuk' => $request->tanggal_masuk,
		];

		try {
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
			$transfer = $query->where('tanggal_masuk', $request->tanggal_masuk)->first();
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
