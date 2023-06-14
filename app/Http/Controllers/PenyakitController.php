<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    protected $penyakit;

    public function __construct()
    {
        $this->penyakit = new Penyakit();
    }

    public function cari(Request $request)
    {
        $penyakit = $this->penyakit::where('kd_penyakit', 'like', $request->kd_penyakit . '%')
            ->orWhere('nm_penyakit', 'like', $request->kd_penyakit . '%')
            ->limit(10)
            ->get();

        return response()->json($penyakit);
    }
}
