<?php

namespace App\Http\Action;

use App\Http\Controllers\TrackerSqlController;
use App\Models\ResepObat;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateJamResepObat
{
	public function handle(ResepObat $resepObat, Request $request): JsonResponse
	{
		$resep = $resepObat->where('no_rawat', $request->no_rawat)
			->where('tgl_perawatan', '0000-00-00')
			->where('jam', '00:00:00')->first();
		try {
			if ($resep) {
				$jamUpdate = ['jam_peresepan' => date('H:i:s')];
				$update = $resepObat->where('no_rawat', $request->no_rawat)->update($jamUpdate);
				if($update){
					$track =  new TrackerSqlController();
					$track->updateSql($resep, $jamUpdate, ['no_rawat' => $request->no_rawat]);
				}
			}
		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}

		return response()->json('SUKSES');
	}
}