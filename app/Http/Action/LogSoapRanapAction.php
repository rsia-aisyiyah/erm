<?php

namespace App\Http\Action;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogSoapRanapAction
{
	public function handle(Request $request, string $action)
	{
		Log::channel('pemeriksaanRanapLogs')->info($action.' PEMERIKSAAN RANAP '.$request->no_rawat.' OLEH '.strtoupper(session()->get('pegawai')->nama), [
			'pegawai_nik'   => session()->get('pegawai')->nik,
			'pegawai_nama'  => session()->get('pegawai')->nama,
			'ip_address'    => $request->ip(),
			'endpoint'      => $request->path(),
			'input'         => $request->except(['password']), // hindari info sensitif
		]);
	}
}