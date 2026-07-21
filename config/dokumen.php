<?php

// config/dokumen.php
// Daftar SEMUA jenis dokumen tanda tangan, walau tabelnya terpisah-pisah.
// Tambah jenis dokumen baru cukup tambah 1 baris di sini + 1 resolver baru,
// tanpa mengubah service atau controller sama sekali.

return [
    'resolvers' => [
        'GENERAL_CONSENT' => \App\Services\Dokumen\Resolvers\PersetujuanUmumResolver::class,

        // tambahkan berikutnya seiring migrasi:
        // 'OPERATIVE_CONSENT'  => \App\Services\Dokumen\Resolvers\PersetujuanOperasiResolver::class,
        // 'ANESTHESIA_CONSENT' => \App\Services\Dokumen\Resolvers\PersetujuanAnestesiResolver::class,
        // 'BIRTH_CERTIFICATE'  => \App\Services\Dokumen\Resolvers\SuratLahirResolver::class,
        // 'DEATH_CERTIFICATE'  => \App\Services\Dokumen\Resolvers\SuratKematianResolver::class,
        // 'MEDICAL_RESUME'     => \App\Services\Dokumen\Resolvers\ResumeMedisResolver::class,
        // 'SEP_BPJS'           => \App\Services\Dokumen\Resolvers\SepBpjsResolver::class,
        // 'RADIOLOGY_RESULT'   => \App\Services\Dokumen\Resolvers\HasilRadiologiResolver::class,
        // 'EKG_RESULT'         => \App\Services\Dokumen\Resolvers\HasilEkgResolver::class,
    ],
];