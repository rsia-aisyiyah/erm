<?php

namespace App\Services;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthVerificationService
{
    public function verifyPassword(string $password)
    {
        $pegawai = session()->get('pegawai');
        if (!$pegawai || empty($pegawai->nik)) {
            return null;
        }

        $username = $pegawai->nik;

        return User::select(
            DB::raw("AES_DECRYPT(id_user, 'nur') as username")
        )
            ->whereRaw("id_user = AES_ENCRYPT(?, 'nur')", [$username])
            ->whereRaw("password = AES_ENCRYPT(?, 'windi')", [$password])
            ->first();
    }
    public function verifyUser()
    {
        $pegawai = session()->get('pegawai');
        if (!$pegawai || empty($pegawai->nik)) {
            return null;
        }

        return Petugas::where('nip', $pegawai->nik)->first();
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
