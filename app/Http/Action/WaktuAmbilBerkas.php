<?php

namespace App\Http\Action;

use App\Http\Controllers\RsiaAmbilBerkasController;
use Illuminate\Http\Request;

class WaktuAmbilBerkas
{
	protected $berkas;
	public function __construct()
	{
		$this->berkas = new RsiaAmbilBerkasController();
	}
	function handle(Request $request) : void
	{
		if ($this->berkas->isAvailable($request->no_rawat)) {
			$this->berkas->updateWaktu($request->no_rawat);
		} else {
			$this->berkas->create(
				[
					'kd_dokter' => $request->kd_dokter,
					'kd_poli' => $request->kd_poli,
					'no_rawat' => $request->no_rawat,
					'no_rkm_medis' => $request->no_rkm_medis,
					'waktu' => "0000-00-00 00:00:00",
					'waktu_soap' => date('Y-m-d H:i:s'),
				]
			);
		}
	}
}