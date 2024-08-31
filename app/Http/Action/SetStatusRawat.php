<?php

namespace App\Http\Action;

use App\Http\Controllers\TrackerSqlController;
use App\Models\RegPeriksa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SetStatusRawat
{
	protected $regPeriksa;
	protected $track;

	function __construct()
	{
		$this->regPeriksa = new RegPeriksa();
		$this->track = new TrackerSqlController();
	}

	public function handle(Request $request, $status) : JsonResponse
	{
		try {
			$create = $this->regPeriksa->where('no_rawat', $request->no_rawat)->update($status);
			if ($create) {
				$this->track->insertSql($this->regPeriksa, ['stts' => $status]);
			}

		} catch (QueryException $e) {
			return response()->json($e->errorInfo, 500);
		}
		return response()->json('SUKSES');
	}

}