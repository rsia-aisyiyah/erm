<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // get domain name
        $domain = $request->getHost();

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $user = User::select('*', DB::raw("AES_DECRYPT(id_user, 'nur') as username, AES_DECRYPT(password, 'windi') as passwd"))
                ->where('id_user', DB::raw("AES_ENCRYPT('" . $request->username . "', 'nur')"))
                ->where('password', DB::raw("AES_ENCRYPT('" . $request->password . "', 'windi')"))
                ->first();

            if ($user) {

                /** 
                 * Pembatasan login dari domain sim.rsiaaisyiyah.com
                 */
                if ($domain == 'sim.rsiaaisyiyah.com') {
                    /**
                     * Daftar user yang diizinkan login : 
                     * direksi, verifikator
                     */
                    if (!in_array($user->username, ['direksi', 'verifikator', '1.112.0823', '1.218.0921', '2.311.0314', '1.101.1112'])) {
                        /**
                         * Selain user diatas, maka akan diarahkan ke halaman login dengan pesan error
                         * */
                        return back()->with('error', 'Anda tidak diizinkan login.')->withInput();
                    }
                }

                Auth::login($user);
                $pegawai = Pegawai::where('nik', $request->get('username'))->with(['petugas', 'dokter.jadwal'])->first();
                $request->session()->regenerate();
                Session::put('pegawai', $pegawai);
                Session::put('status', 'ok');
                $role = $pegawai->dokter ? 'dokter' : '';
                Session::put('role', $role);

                return $this->redirectBasedOnRole($pegawai, $request);

            } else {
                return back()->with('error', 'Login Gagal, Periksa Kembali NIK dan Password')
                    ->withInput();
            }
        } catch (QueryException $e) {
            return back()->with('error', 'Login Gagal, Periksa Kembali NIK dan Password')
                ->withInput();

        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function redirectBasedOnRole($pegawai, $request)
    {
        $routes = [
            'DPM1' => '/resep',
            'DNM6' => '/registrasi',
            'DM7' => '/poliklinik/P006?dokter=' . $request->username,
            'DM1' => '/ugd',
            'DM8' => '/ranap',
            'DM3' => '/ranap',
            'DM4' => '/ranap',
            'DNM5' => '/ranap',
            'DM5' => '/ranap',
            'DM2' => '/ranap',
            'DPM2' => '/ranap',
            'RAD' => '/radiologi',
        ];

        if (isset($routes[$pegawai->departemen])) {
            return redirect($routes[$pegawai->departemen]);
        }

        if ($pegawai->jbtn == 'Dokter Spesialis Radiologi') {
            return redirect('/radiologi');
        }

        return redirect('/');
    }
}
