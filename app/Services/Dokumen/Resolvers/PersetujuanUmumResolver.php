<?php

namespace App\Services\Dokumen\Resolvers;

class PersetujuanUmumResolver extends BaseColumnResolver
{
    protected string $table = 'rsia_persetujuan_umum';
    protected string $label = 'Persetujuan Umum';
    protected string $viewTemplate = 'dokumen.partials.general_consent';
    protected string $nomorPrefix = 'PU';
    protected string $storage = 'general_consent';

    protected function konten(object $row): array
    {
        // Field ini tidak ada di tabel dasarmu sekarang — sesuaikan
        // dengan kolom aktual yang kamu punya di rsia_persetujuan_umum.
        return [
            'nama_wali' => $row->nama_wali ?? null,
            'hubungan_pasien' => $row->hubungan_pasien ?? null,
        ];
    }
}