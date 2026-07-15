<?php

namespace App\Services\HasilKritis;

use App\Models\RsiaHasilKritis;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifikasiHasilKritis
{
    public function verifyAndExecute(int $id, string $role): RsiaHasilKritis
    {
        $petugas = $this->verifyUser();

        $hasilKritis = RsiaHasilKritis::findOrFail($id);

        $this->authorizeAndFieldsUpdate($hasilKritis, $petugas, $role);

        return $hasilKritis;
    }

    protected function verifyUser()
    {
        $petugas = session()->get('pegawai');

        if (!$petugas) {
            throw new HttpException(401, 'Session login tidak ditemukan');
        }

        return $petugas;
    }

    protected function authorizeAndFieldsUpdate(RsiaHasilKritis $hasilKritis, $petugas, string $role): void
    {
        switch ($role) {
            case 'petugas_ruang':
                if ($hasilKritis->petugas_ruang != $petugas->nik) {
                    throw new HttpException(403, 'Anda bukan petugas ruangan');
                }

                $hasilKritis->update([
                    'tgl_ruang' => now()
                ]);
                break;

            case 'dokter':
                if ($hasilKritis->dokter != $petugas->nik) {
                    throw new HttpException(403, 'Anda bukan dokter terkait');
                }

                $hasilKritis->update([
                    'tgl_dokter' => now()
                ]);
                break;

            case 'dokter_pj':
                if ($hasilKritis->dokter_pj != $petugas->nik) {
                    throw new HttpException(403, 'Anda bukan Dokter Penanggung Jawab hasil pemeriksaan ini');
                }

                $hasilKritis->update([
                    'tgl_drpj' => now()
                ]);
                break;

            default:
                throw new HttpException(422, 'Role tidak valid');
        }
    }
}