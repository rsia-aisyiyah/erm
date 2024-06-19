<?php

namespace App\Http\Controllers;

use App\Models\MasterAturan;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MasterAturanController extends Controller
{
    use JsonResponseTrait;
    public function cari(Request $request)
    {
        $aturan = MasterAturan::where('aturan', 'like', '%' . $request->aturan . '%')
            ->limit(10)
            ->get();
        return response()->json($aturan);
    }
    public function simpan(Request $request)
    {
        try {
            $aturan = MasterAturan::create([
                'aturan' => $request->aturan,
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal membuat aturan', 500, $e->errorInfo);
        }
        return $this->successResponse($aturan, 'Sukses membuat aturan', 201);
    }
}
