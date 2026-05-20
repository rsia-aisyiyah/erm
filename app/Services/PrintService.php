<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PrintService
{
    public function stream(
        string $view,
        array $data = [],
        string $filename = 'document.pdf',
        array $paper = [0, 0, 595, 935],
        array $options = []
    ) {
        $defaultOptions = [
            'defaultFont' => 'serif',
            'isRemoteEnabled' => true,
        ];

        $pdf = Pdf::loadView($view, $data)
            ->setOption(array_merge($defaultOptions, $options))
            ->setPaper($paper);

        return $pdf->stream($filename);
    }

    public function fingerOutput($dokter, $id, $tanggal): string
    {
        $strId = sha1($id);

        return "Ditandatangani di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, "
            . "Ditandatangani Elektronik Oleh $dokter, "
            . "ID $strId, $tanggal";
    }
}