<?php

namespace App\Http\Controllers;

use App\Models\BridgingSPRI;
use App\Models\RegPeriksa;
use PDF;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BridgingSPRIController extends Controller
{
	protected $pri;
	protected $track;
	protected $carbon;
	public $model;

	public function __construct(RegPeriksa $model)
	{
		$this->pri = new BridgingSPRI();
		$this->track = new TrackerSqlController();
		$this->carbon = new Carbon();
		$this->model = $model;
	}

	function get(Request $request)
	{
		$spri = $this->model
//	        ->whereHas('spri')
			->with(['spri' => function ($q) {
					$q->with(['mappingPoli']);
			}, 'pasien', 'sep', 'penjab'])
			->where('no_rawat', $request->no_rawat)
			->first();
		return response()->json($spri);
	}

	function create(Request $request)

	{
		$data = [
			'no_rawat' => $request->no_rawat,
			'no_kartu' => $request->no_kartu,
			'tgl_surat' => $request->tgl_surat,
			'no_surat' => $request->no_rujukan,
			'tgl_rencana' => $request->tgl_rencana,
			'diagnosa' => $request->diagnosa,
			'kd_dokter_bpjs' => $request->kd_dokter_bpjs,
			'nm_dokter_bpjs' => $request->nm_dokter_bpjs,
			'kd_poli_bpjs' => $request->kd_poli_bpjs,
			'nm_poli_bpjs' => ucfirst(strtolower($request->nm_poli_bpjs)),
			'no_sep' => '-',
		];

		try {
			$spri = $this->pri->create($data);
			$this->track->insertSql($this->pri, $data);
			return response()->json($spri);
		} catch (QueryException $e) {
			return response()->json($e->errorInfo);
		}
	}

	function print($no_surat)
	{
		$spri = $this->pri->where('no_surat', $no_surat)->with('pasien')->first();
		$dataSpri = [
			'noSurat' => $spri->no_surat,
			'nmPasien' => $spri->pasien->nm_pasien,
			'tglLahir' => $this->carbon->parse($spri->pasien->tgl_lahir)->translatedFormat('d F Y'),
			'jkel' => $spri->pasien->jk == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN',
			'tglSurat' => $this->carbon->parse($spri->tgl_surat)->translatedFormat('d F Y'),
			'tglRencana' => $this->carbon->parse($spri->tgl_rencana)->translatedFormat('d F Y'),
			'nmDokter' => $spri->nm_dokter_bpjs,
			'noKartu' => $spri->no_kartu,
			'diagnosa' => $spri->diagnosa,
			'tglCetak' => date('d/m/Y H:i:s'),
		];

		$file = PDF::loadView('content.print.spri', ['spri' => $dataSpri])->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);
		return $file->stream($spri->no_surat . '.pdf');
	}
}
