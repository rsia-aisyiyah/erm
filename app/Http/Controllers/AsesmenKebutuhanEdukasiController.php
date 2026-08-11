<?php

namespace App\Http\Controllers;

use App\Models\AsesmenKebutuhanEdukasi;
use App\Models\RegPeriksa;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDF;

class AsesmenKebutuhanEdukasiController extends Controller
{
	protected $asesmen;
	protected $track;

	public function __construct(AsesmenKebutuhanEdukasi $asesmen)
	{
		$this->asesmen = $asesmen;
		$this->track = new TrackerSqlController();
	}

	public function get(Request $request): JsonResponse
	{
		$query = $this->asesmen->with(['pasien', 'regPeriksa', 'dokter', 'petugas', 'pegawai']);

		if ($request->no_rawat) {
			$data = $query->where('no_rawat', $request->no_rawat)->first();
		} else {
			$data = $query->get();
		}

		return response()->json($data);
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'tanggal' => 'required',
			'ruang' => 'nullable',
			'nip' => 'required',
			'agama_keyakinan' => 'nullable',
			'bahasa_indonesia' => 'nullable',
			'bahasa_daerah' => 'nullable',
			'bahasa_daerah_status' => 'nullable',
			'bahasa_inggris' => 'nullable',
			'bahasa_lain' => 'nullable',
			'bahasa_lain_status' => 'nullable',
			'perlu_penerjemah' => 'nullable',
			'penerjemah_bahasa' => 'nullable',
			'bahasa_isyarat' => 'nullable',
			'bahasa_isyarat_ket' => 'nullable',
			'cara_belajar' => 'nullable',
			'tingkat_pendidikan' => 'nullable',
			'pendidikan_lain' => 'nullable',
			'mampu_membaca' => 'nullable',
			'hambatan_emosi' => 'nullable',
			'kesediaan_menerima' => 'nullable',
			'keterbatasan_fisik' => 'nullable',
			'kebutuhan_edukasi' => 'nullable',
			'kebutuhan_edukasi_lain' => 'nullable',
			'rencana_pelaksanaan' => 'nullable',
			'tabel_rencana' => 'nullable',
		]);

		if (isset($data['cara_belajar']) && is_array($data['cara_belajar'])) {
			$data['cara_belajar'] = implode(', ', $data['cara_belajar']);
		}
		if (isset($data['kebutuhan_edukasi']) && is_array($data['kebutuhan_edukasi'])) {
			$data['kebutuhan_edukasi'] = implode("\n", $data['kebutuhan_edukasi']);
		}
		if (isset($data['tabel_rencana']) && is_array($data['tabel_rencana'])) {
			$data['tabel_rencana'] = json_encode($data['tabel_rencana']);
		}

		$isExist = $this->asesmen->where('no_rawat', $data['no_rawat'])->count();

		try {
			if ($isExist) {
				$clause = ['no_rawat' => $data['no_rawat']];
				$query = $this->asesmen->where($clause)->update($data);
				try {
					$this->track->updateSql($this->asesmen, $data, $clause);
				} catch (\Throwable $t) {
					// ignore tracker failure
				}
				return response()->json('Berhasil memperbarui asesmen kebutuhan edukasi (RM 20)');
			} else {
				$query = $this->asesmen->insert($data);
				try {
					$this->track->insertSql($this->asesmen, $data);
				} catch (\Throwable $t) {
					// ignore tracker failure
				}
				return response()->json('Berhasil menyimpan asesmen kebutuhan edukasi (RM 20)');
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
	}

	public function printRm20(Request $request)
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

		$asesmen = AsesmenKebutuhanEdukasi::with(['petugas', 'pegawai'])->where('no_rawat', $cleanNoRawat)->first();

		$pdf = PDF::loadView('content.print.catatan_edukasi_rm20', [
			'regPeriksa' => $regPeriksa,
			'asesmen' => $asesmen,
		])->setPaper('A4', 'portrait');

		return $pdf->stream('RM20_Asesmen_Edukasi_' . str_replace('/', '_', $cleanNoRawat) . '.pdf');
	}
}
