<?php

namespace App\Http\Middleware;

use App\Models\Pegawai;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EnsureErmSessionValid
{
    /**
     * Daftar NIK yang diizinkan mengakses dari domain publik.
     * (Fallback selama belum dipindah ke tabel rsia_erm_users)
     */
    protected array $userPublic = [
        'direksi',
        'verifikator',
        '1.112.0823',
        '1.218.0921',
        '2.311.0314',
        '1.101.1112',
        '1.114.0525',
        '1.210.0825',
        '2.326.0418',
        '2.357.0121',
        '2.423.0418',
        '2.310.0113',
        '3.402.1023',
        '2.319.1017',
    ];

    /**
     * Pastikan sesi pegawai ERM utuh & valid pada setiap request terautentikasi.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $this->rejectSession($request, 'Sesi login tidak ditemukan. Silakan login kembali.');
        }

        $pegawai = Session::get('pegawai');

        // Jika sesi pegawai hilang / korup padahal Auth::check() aktif, coba rehidrasi dari Auth::user()
        if (empty($pegawai) || empty($pegawai->nik)) {
            $pegawai = $this->rehydratePegawaiFromAuth();
            if (!$pegawai) {
                return $this->rejectSession($request, 'Sesi pegawai tidak valid atau telah berakhir. Silakan login kembali.');
            }
        }

        // Validasi ulang pembatasan domain publik (jika diakses lewat sim.rsiaaisyiyah.com)
        $publicDomain = config('app.public_domain', 'sim.rsiaaisyiyah.com');
        if ($publicDomain && $request->getHost() === $publicDomain) {
            if (!in_array($pegawai->nik, $this->userPublic, true)) {
                return $this->rejectSession($request, 'Akun Anda tidak diizinkan mengakses melalui domain publik.');
            }
        }

        return $next($request);
    }

    /**
     * Coba pulihkan data pegawai ke session dari user terautentikasi saat ini.
     */
    protected function rehydratePegawaiFromAuth(): ?Pegawai
    {
        $authUser = Auth::user();
        if (!$authUser || empty($authUser->id_user)) {
            return null;
        }

        $row = DB::table('user')
            ->selectRaw("AES_DECRYPT(id_user, 'nur') as username")
            ->where('id_user', $authUser->id_user)
            ->first();

        if (!$row || empty($row->username)) {
            return null;
        }

        $pegawai = Pegawai::where('nik', $row->username)
            ->with(['petugas', 'dokter.jadwal', 'dep'])
            ->first();

        if (!$pegawai) {
            return null;
        }

        Session::put('pegawai', $pegawai);
        Session::put('status', 'ok');
        Session::put('role', $pegawai->dokter ? 'dokter' : ($pegawai->dep->nama ?? 'Staff'));

        return $pegawai;
    }

    /**
     * Putuskan sesi secara aman dan kembalikan response 401 (AJAX/JSON) atau redirect ke login.
     */
    protected function rejectSession(Request $request, string $message)
    {
        Auth::logout();
        Session::flush();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], 401);
        }

        return redirect()->route('login')->with('error', $message);
    }
}
