<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $user = User::select('*', DB::raw("AES_DECRYPT(id_user, 'nur') as username, AES_DECRYPT(password, 'windi') as passwd"))
            ->where('id_user', DB::raw("AES_ENCRYPT('" . $request->get('username') . "', 'nur')"))
            ->where('password', DB::raw("AES_ENCRYPT('" . $request->get('password') . "', 'windi')"))
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
                if (!in_array($user->username, ['direksi', 'verifikator', '1.112.0823', '1.218.0921', '2.311.0314'])) {
                    /**
                     * Selain user diatas, maka akan diarahkan ke halaman login dengan pesan error
                     * */
                    return back()->with('error', 'Anda tidak diizinkan login.');
                }
            }

            Auth::login($user);
            $pegawai = Pegawai::where('nik', $request->get('username'))->with(['petugas', 'departement', 'dokter.jadwal'])->first();
            $request->session()->regenerate();
            $role = '';
            if ($pegawai->dokter) {
                $role = 'dokter';
            } else {
                $role = 'petugas';
            }
            Session::put([
                'statsu' => 'OK',
                'pegawai' => $pegawai,
                'departemen' => strtolower($pegawai->departement->nama),
                'role' => $role,
            ]);

            if ($pegawai->departemen == 'DPM1') {
                return redirect('/resep');
            } else if ($pegawai->departemen == 'DNM6') {
                return redirect('/registrasi');
            } else if ($pegawai->departemen == 'DM7') {
                return redirect('/poliklinik/P006?dokter=' . $request->get('username'));
            } else if ($pegawai->departemen == 'DM1') {
                return redirect('ugd');
            } else if (
                $pegawai->departemen == 'DM8' || $pegawai->departemen == 'DM3' || $pegawai->departemen == 'DM4' ||
                $pegawai->departemen == 'DNM5' || $pegawai->departemen == 'DM5' || $pegawai->departemen == 'DM2' || $pegawai->departemen == 'DPM2'
            ) {
                return redirect('ranap');
            } else if ($pegawai->departemen == 'RAD' || $pegawai->jbtn == 'Dokter Spesialis Radiologi') {
                return redirect('radiologi');
            } else if ($pegawai->nik == 'direksi' || $pegawai->departemen == 'DM6' || $pegawai->departemen == 'SPS' || $pegawai->jbtn != 'Dokter Spesialis Radiologi' || $pegawai->jnj_jabatan == 'DIRU' || $pegawai->departemen == 'DIR' || $pegawai->departemen == 'CSM') {
                return redirect('/');
            }
        } else {
            return back()->with('error', 'Login Gagal, Periksa Kembali NIK dan Password');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
