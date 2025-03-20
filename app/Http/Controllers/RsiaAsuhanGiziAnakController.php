<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsuhanGiziAnak;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RsiaAsuhanGiziAnakController extends Controller
{
	protected TrackerSqlController $tracker;

	function __construct(TrackerSqlController $tracker)
	{
		$this->tracker = $tracker;
	}
	function get(RsiaAsuhanGiziAnak $model, Request $request): JsonResponse
	{
		$get = $model->where(['no_rawat' => $request->no_rawat])->first();
		if ($get) {
			return response()->json($get, 200);
		}
		return response()->json(null, 200);
	}
	function create(RsiaAsuhanGiziAnak $model, Request $request): JsonResponse
	{
		$data = $request->except('_token');
		$data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();
		$isExist = $model->where('no_rawat', $data['no_rawat'])->first();
		if ($isExist) {
			return $this->update($model, $request);
		}

		try {
			$create = $model->create($data);
			if ($create) {
				$this->tracker->insertSql($model, $data);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
		return response()->json('Berhasil', 200);
	}

	function update(RsiaAsuhanGiziAnak $model, Request $request): JsonResponse
	{
		$data = $request->except('_token');
		$data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();

		try {
			$update = $model->where('no_rawat', $data['no_rawat'])->update($data);
			if ($update) {
				$this->tracker->updateSql($model, $data, ['no_rawat' => $data['no_rawat']]);
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
		return response()->json('Berhasil', 200);
	}
	function print(RsiaAsuhanGiziAnak $model, Request $request)
	{

		$asuhanGizi = $model
			->where('no_rawat', $request->no_rawat)
			->with('regPeriksa', 'pasien', 'pegawai', 'kamarInap')
			->first();

		$pasien = [
			'nm_pasien' => $asuhanGizi->pasien->nm_pasien,
			'umur' => $asuhanGizi->regPeriksa->umurdaftar . ' ' . $asuhanGizi->regPeriksa->sttsumur,
			'no_rkm_medis' => $asuhanGizi->pasien->no_rkm_medis,
			'diagnosa_awal' => $asuhanGizi->kamarInap->diagnosa_awal,
			'jk' => $asuhanGizi->pasien->jk === 'L' ? 'Laki-laki' : 'Perempuan',
			'tgl_lahir' => Carbon::parse($asuhanGizi->pasien->tgl_lahir)->format('d-m-Y'),
		];
		$petugas = [
			'nip' => $asuhanGizi->nip,
			'nama' => $asuhanGizi->pegawai->nama,
			'ttd' => $this->setFingerOutput($asuhanGizi->pegawai->nama, bcrypt($asuhanGizi->nip), date('Y-m-d H:i:s'))
		];
		$asuhanGizi['tanggal'] = Carbon::parse($asuhanGizi->tanggal)->format('d-m-Y H:i:s');


		$pdf = Pdf::loadView(
			'content.print.asuhan_gizi_anak',
			[
				'asuhanGizi' => $asuhanGizi,
				'pasien' => $pasien,
				'petugas' => $petugas
			]
		)
			->setOption(['defaultFont' => 'serif', 'isRemoteEnabled' => true])
			->setPaper(array(0, 0, 595, 935));

		return $pdf->stream(date('YmdHis') . '.pdf');
	}

	function setFingerOutput($dokter, $id, $tanggal)
	{
		$strId = sha1($id);
		return "Ditandatangani di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh $dokter, ID $strId, $tanggal";
	}
}
