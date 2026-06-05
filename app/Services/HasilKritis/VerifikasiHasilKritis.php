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

    public function verifyAndExecute(int $id, string $password, string $role): RsiaHasilKritis
    {
        $petugas = $this->verifyUserCredentials($password);
        $hasilKritis = RsiaHasilKritis::findOrFail($id);

        $this->authorizeAndFieldsUpdate($hasilKritis, $petugas, $role);

        return $hasilKritis;
    }

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
     * MODIFIKASI: Menambahkan Case Otorisasi untuk Dokter Penanggung Jawab (PJ)
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

            // TAMBAHAN: Role baru untuk verifikasi Dokter PJ Laboratorium / Radiologi
            case 'dokter_pj':
                if ($hasilKritis->dokter_pj != $petugas->nip) {
                    throw new HttpException(403, 'Anda bukan Dokter Penanggung Jawab hasil pemeriksaan ini');
                }
                $hasilKritis->update(['tgl_drpj' => now()]);
                break;

            default:
                throw new HttpException(422, 'Role tidak valid');
        }
    }
}