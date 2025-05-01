<?php

namespace App\Http\Controllers;

use App\Models\Icd9;
use Illuminate\Http\Request;

class Icd9Controller extends Controller
{
    private $icd;
    public function __construct()
    {
        $this->icd = new Icd9();
    }

    public function cari(Request $request)
    {
        $icd = $this->icd->where('kode', 'like',  $request->kode . '%')
            ->orWhere('deskripsi_panjang', 'like', '%' . $request->kode . '%')
            ->limit(10)
            ->get();

        return response()->json($icd);
    }
}
