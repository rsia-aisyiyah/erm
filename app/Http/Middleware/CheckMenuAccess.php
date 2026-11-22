<?php

namespace App\Http\Middleware;

use App\Models\RsiaErmMenu;
use Closure;
use Illuminate\Http\Request;

class CheckMenuAccess
{
    /**
     * Proteksi backend berdasarkan hak akses menu di tabel rsia_erm_menu*.
     *
     * Pemakaian di route:
     *   ->middleware('erm.menu:pengaturan/menu')
     *   ->middleware('erm.menu:ugd,ranap') // Diizinkan jika punya akses UGD ATAU Ranap
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$menuPaths
     */
    public function handle(Request $request, Closure $next, ...$menuPaths)
    {
        $pegawai = session()->get('pegawai');

        if (!$pegawai || empty($pegawai->nik)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login berakhir. Silakan login kembali.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika tidak ada parameter menu yang diberikan, lanjutkan
        if (empty($menuPaths)) {
            return $next($request);
        }

        // Diizinkan jika user memiliki akses ke salah satu menu yang disyaratkan (OR logic)
        foreach ($menuPaths as $menuPath) {
            if (RsiaErmMenu::canUserAccess($pegawai, $menuPath)) {
                return $next($request);
            }
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki hak akses untuk fitur atau modul ini.',
            ], 403);
        }

        abort(403, 'Anda tidak memiliki hak akses ke halaman ini. Hubungi unit IT jika Anda memerlukan akses.');
    }
}
