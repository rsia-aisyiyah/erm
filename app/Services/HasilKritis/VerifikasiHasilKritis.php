<?php

namespace App\Services\HasilKritis;

use App\Models\RsiaHasilKritis;
use App\Services\AuthVerificationService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifikasiHasilKritis
{
    protected $authVerifyService;
    public function __construct(AuthVerificationService $authVerifyService)
    {
        $this->authVerifyService = $authVerifyService;
    }
    /**
     * 1. FUNGSI UTAMA (Orchestrator)
     * Mengatur jalannya proses verifikasi hasil kritis
     */
    public function verifyAndExecute(int $id, string $password, string $role): RsiaHasilKritis
    {
        // Jalankan verifikasi kredensial user
        $petugas = $this->verifyUserCredentials($password);

        // Cari data hasil kritis, otomatis memicu 404 jika tidak ketemu
        $hasilKritis = RsiaHasilKritis::findOrFail($id);

        // Jalankan validasi role dan update data
        $this->authorizeAndFieldsUpdate($hasilKritis, $petugas, $role);

        return $hasilKritis;
    }

    /**
     * 2. FUNGSI AUTENTIKASI
     * Khusus menangani validasi user dan password
     */
    protected function verifyUserCredentials(string $password)
    {
        $petugas = $this->authVerifyService->verifyUser();

        if (!$petugas) {
            throw new HttpException(404, 'User tidak ditemukan');
        }

        $isValidPassword = $this->authVerifyService->verifyPassword($password);

        if (!$isValidPassword) {
            throw new HttpException(422, 'Password salah');
        }

        return $petugas;
    }

    /**
     * 3. FUNGSI OTORISASI & UPDATE
     * Khusus memvalidasi kesesuaian NIP petugas/dokter dan eksekusi timestamps
     */
    protected function authorizeAndFieldsUpdate(RsiaHasilKritis $hasilKritis, $petugas, string $role): void
    {
        switch ($role) {
            case 'petugas_ruang':
                if ($hasilKritis->petugas_ruang != $petugas->nip) {
                    throw new HttpException(403, 'Anda bukan petugas ruangan');
                }
                $hasilKritis->update(['tgl_ruang' => now()]);
                break;

            case 'dokter':
                if ($hasilKritis->dokter != $petugas->nip) {
                    throw new HttpException(403, 'Anda bukan dokter terkait');
                }
                $hasilKritis->update(['tgl_dokter' => now()]);
                break;

            default:
                throw new HttpException(422, 'Role tidak valid');
        }
    }
}
