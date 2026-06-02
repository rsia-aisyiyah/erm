<?php

namespace App\Services;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthVerificationService
{
    public function verifyPassword(string $password)
    {
        $username = session()->get('pegawai')->nik;

        return User::select(
            DB::raw("AES_DECRYPT(id_user, 'nur') as username")
        )
            ->where(
                'id_user',
                DB::raw("AES_ENCRYPT('" . $username . "', 'nur')")
            )
            ->where(
                'password',
                DB::raw("AES_ENCRYPT('" . $password . "', 'windi')")
            )
            ->first();
    }
    public function verifyUser()
    {
        $username = session()->get('pegawai')->nik;

        return Petugas::where('nip', $username)->first();
    }
    public function verifyRole($model, $petugas, string $role): bool
    {
        $roles = [
            'petugas' => 'petugas',
            'petugas_ruang' => 'petugas_ruang',
            'dokter' => 'dokter',
            'analis_lab' => 'analis_lab',
            'radiografer' => 'radiografer',
            'verifikator' => 'verifikator',
            'kepala_ruangan' => 'kepala_ruangan',
            'farmasi' => 'farmasi',
            'kasir' => 'kasir'
        ];
        if (!isset($roles[$role])) {
            return false;
        }
        $field = $roles[$role];
        if (!isset($model->$field)) {
            return false;
        }
        return $model->$field == $petugas->nip;
    }
}
