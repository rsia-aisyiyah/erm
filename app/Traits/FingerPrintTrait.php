<?php

namespace App\Traits;

trait FingerPrintTrait
{
    protected function setFingerOutput(
        string $petugas,
        string $id,
        string $tanggal
    ): string {

        return sprintf(
            'Ditandatangani di RSIA Aisyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh %s, ID %s, %s',
            $petugas,
            sha1($id),
            $tanggal
        );
    }
}