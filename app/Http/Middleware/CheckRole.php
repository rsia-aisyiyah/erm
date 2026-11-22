<?php

namespace App\Http\Middleware;

use App\Models\RsiaErmMenu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Proteksi aksi medikolegal / administratif berdasarkan profesi atau role terverifikasi di session.
     *
     * Pemakaian di route:
     *   ->middleware('erm.role:dokter')
     *   ->middleware('erm.role:superadmin,farmasi')
     *   ->middleware('erm.role:dep:DPM1,dep:IT')
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
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

        foreach ($roles as $role) {
            if ($this->matchesRole($pegawai, trim($role))) {
                return $next($request);
            }
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Aksi ini hanya diizinkan untuk profesi/role: ' . implode(', ', $roles) . '.',
            ], 403);
        }

        abort(403, 'Anda tidak memiliki otorisasi profesi untuk mengakses fitur ini.');
    }

    protected function matchesRole($pegawai, string $role): bool
    {
        $roleLower = strtolower($role);
        $nik = (string) ($pegawai->nik ?? '');
        $dept = strtoupper((string) ($pegawai->departemen ?? ''));
        $jbtn = strtolower((string) ($pegawai->jbtn ?? ''));

        // Cek kode departemen eksplisit, misal "dep:DPM1"
        if (str_starts_with($roleLower, 'dep:')) {
            $targetDept = strtoupper(substr($role, 4));
            return $dept !== '' && $dept === $targetDept;
        }

        switch ($roleLower) {
            case 'superadmin':
            case 'admin':
                return RsiaErmMenu::isSuperAdmin($pegawai);

            case 'dokter':
                if (!empty($pegawai->dokter)) {
                    return true;
                }
                return DB::table('dokter')->where('kd_dokter', $nik)->exists();

            case 'farmasi':
            case 'apoteker':
                return $dept === 'DPM1'
                    || str_contains($jbtn, 'apoteker')
                    || str_contains($jbtn, 'farmasi')
                    || str_contains($jbtn, 'ttk');

            case 'perawat':
            case 'bidan':
            case 'petugas':
                return !empty($pegawai->petugas)
                    || str_contains($jbtn, 'perawat')
                    || str_contains($jbtn, 'bidan');

            case 'radiologi':
                return $dept === 'RAD'
                    || str_contains($jbtn, 'radiologi');

            default:
                return $dept === strtoupper($role);
        }
    }
}
