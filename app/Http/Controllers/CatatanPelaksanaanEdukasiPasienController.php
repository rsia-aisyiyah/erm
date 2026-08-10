<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelaksanaanEdukasiPasien;
use App\Models\RegPeriksa;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class CatatanPelaksanaanEdukasiPasienController extends Controller
{
	protected $catatan;
	protected $track;

	public function __construct(CatatanPelaksanaanEdukasiPasien $catatan)
	{
		$this->catatan = $catatan;
		$this->track = new TrackerSqlController();
	}

	public function get(Request $request): JsonResponse
	{
		$query = $this->catatan->with(['pasien', 'regPeriksa', 'dokter', 'petugas']);

		if ($request->no_rawat) {
			$query->where('no_rawat', $request->no_rawat);
		}

		if ($request->jenis_form) {
			$query->where('jenis_form', $request->jenis_form);
		}

		if ($request->tanggal) {
			$data = $query->where('tanggal', $request->tanggal)->first();
		} else {
			$data = $query->orderBy('tanggal', 'asc')->get();
		}

		return response()->json($data);
	}

	protected function handleSignature(string $noRawat, ?string $signatureData): ?string
	{
		if (empty($signatureData)) {
			return null;
		}

		// Jika sudah merupakan path file tersimpan (bukan data Base64 baru), pertahankan
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
		$folder = 'signatures/catatan_edukasi_pasien';

		if (!Storage::disk('public')->exists($folder)) {
			Storage::disk('public')->makeDirectory($folder);
		}

		$fileName = 'ttd_' . $cleanNoRawat . '_' . time() . '.png';
		$filePath = $folder . '/' . $fileName;

		Storage::disk('public')->put($filePath, $binary);

		return $filePath;
	}

	public function create(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'jenis_form' => 'nullable',
			'disiplin' => 'nullable',
			'materi' => 'required',
			'tanggal' => 'required',
			'durasi' => 'nullable',
			'nip' => 'required',
			'metode' => 'required',
			'evaluasi' => 'required',
			'hambatan_lain' => 'nullable',
			'intervensi_lain' => 'nullable',
			'hambatan' => 'nullable',
			'intervensi' => 'nullable',
			'nama_penerima' => 'nullable',
			'ttd_pasien' => 'nullable',
		]);

		$data['jenis_form'] = $data['jenis_form'] ?? 'RM 23';

		if (!empty($data['ttd_pasien'])) {
			$data['ttd_pasien'] = $this->handleSignature($data['no_rawat'], $data['ttd_pasien']);
		}

		$isExist = $this->catatan->where([
			'no_rawat' => $data['no_rawat'],
			'tanggal' => $data['tanggal']
		])->count();

		if ($isExist) {
			return $this->update($request);
		}

		try {
			$query = $this->catatan->insert($data);
			if ($query) {
				$this->track->insertSql($this->catatan, $data);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
		return response()->json('Berhasil menambah catatan edukasi pasien');
	}

	public function update(Request $request): JsonResponse
	{
		$data = $request->validate([
			'no_rawat' => 'required',
			'jenis_form' => 'nullable',
			'disiplin' => 'nullable',
			'materi' => 'required',
			'tanggal' => 'required',
			'durasi' => 'nullable',
			'nip' => 'required',
			'metode' => 'required',
			'evaluasi' => 'required',
			'hambatan_lain' => 'nullable',
			'intervensi_lain' => 'nullable',
			'hambatan' => 'nullable',
			'intervensi' => 'nullable',
			'nama_penerima' => 'nullable',
			'ttd_pasien' => 'nullable',
		]);

		if (!empty($data['ttd_pasien'])) {
			$data['ttd_pasien'] = $this->handleSignature($data['no_rawat'], $data['ttd_pasien']);
		}

		try {
			$clause = [
				'no_rawat' => $data['no_rawat'],
				'tanggal' => $data['tanggal']
			];
			$query = $this->catatan->where($clause)->update($data);
			if ($query) {
				$this->track->updateSql($this->catatan, $data, $clause);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}

		return response()->json('Berhasil mengubah catatan edukasi pasien');
	}

	public function delete(Request $request): JsonResponse
	{
		$clause = [
			'no_rawat' => $request->no_rawat,
			'tanggal' => $request->tanggal,
			'nip' => $request->nip
		];
		try {
			$record = $this->catatan->where($clause)->first();
			if ($record && !empty($record->ttd_pasien)) {
				Storage::disk('public')->delete($record->ttd_pasien);
			}

			$query = $this->catatan->where($clause)->delete();
			if ($query) {
				$this->track->deleteSql($this->catatan, $clause);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}

		return response()->json('Berhasil menghapus catatan edukasi pasien');
	}

	public function printRm23(Request $request)
	{
		$noRawat = str_replace('-', '/', $request->no_rawat);
		$regPeriksa = RegPeriksa::with(['pasien', 'kamarInap.kamar.bangsal', 'dokter', 'poliklinik'])
			->where('no_rawat', $noRawat)
			->first();

		if (!$regPeriksa) {
			return abort(404, 'Data Pasien tidak ditemukan');
		}

		$edukasiList = $this->catatan->with(['petugas'])
			->where('no_rawat', $noRawat)
			->where('jenis_form', 'RM 23')
			->orderBy('tanggal', 'asc')
			->get();

		$pdf = PDF::loadView('content.print.catatan_edukasi_rm23', [
			'regPeriksa' => $regPeriksa,
			'edukasiList' => $edukasiList
		])->setPaper('a4', 'portrait');

		return $pdf->stream('RM23_Edukasi_Multidisiplin_' . $request->no_rawat . '.pdf');
	}

	public function printRm24(Request $request)
	{
		$noRawat = str_replace('-', '/', $request->no_rawat);
		$regPeriksa = RegPeriksa::with(['pasien', 'kamarInap.kamar.bangsal', 'dokter', 'poliklinik'])
			->where('no_rawat', $noRawat)
			->first();

		if (!$regPeriksa) {
			return abort(404, 'Data Pasien tidak ditemukan');
		}

		$edukasiList = $this->catatan->with(['petugas'])
			->where('no_rawat', $noRawat)
			->where('jenis_form', 'RM 24')
			->orderBy('tanggal', 'asc')
			->get();

		$pdf = PDF::loadView('content.print.catatan_edukasi_rm24', [
			'regPeriksa' => $regPeriksa,
			'edukasiList' => $edukasiList
		])->setPaper('a4', 'portrait');

		return $pdf->stream('RM24_Catatan_Edukasi_' . $request->no_rawat . '.pdf');
	}
}
