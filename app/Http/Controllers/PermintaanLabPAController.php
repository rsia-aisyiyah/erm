<?php

namespace App\Http\Controllers;

use App\Models\PermintaanLabPA;
use Illuminate\Http\Request;

class PermintaanLabPAController extends Controller
{
    protected PermintaanLabPA $model;

	public function __construct(PermintaanLabPA $model){
		$this->model = $model;
	}

	public function get(Request $request){
		return $this->model
			->with('pemeriksaan.jenis', 'detail')
			->where('noorder', $request->noorder)->get();
	}
}
