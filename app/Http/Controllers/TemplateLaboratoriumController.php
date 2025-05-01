<?php

namespace App\Http\Controllers;

use App\Models\TemplateLaboratorium;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemplateLaboratoriumController extends Controller
{
    protected $template;
    public function __construct()
    {
        $this->template = new TemplateLaboratorium();
    }
    function get(Request $request): JsonResponse
    {
        $template = $this->template->whereIn('kd_jenis_prw', $request->kode)->get();
        return response()->json($template);
    }
}
