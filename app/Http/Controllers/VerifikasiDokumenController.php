<?php

namespace App\Http\Controllers;

use App\Services\Dokumen\DokumenResolverRegistry;
use Illuminate\Http\Request;

class VerifikasiDokumenController extends Controller
{
    public function __construct(private DokumenResolverRegistry $registry)
    {
    }

    /**
     * GET /verify/{uuid}
     *
     * Satu method ini menggantikan verify() versi lama yang hanya menangani
     * rsia_persetujuan_umum. Sekarang berlaku untuk SEMUA jenis dokumen
     * yang resolvernya sudah didaftarkan di config/dokumen.php — tidak ada
     * percabangan if/switch per jenis di sini.
     */
    public function verify(string $uuid)
    {
        $kode = $this->registry->findKodeByUuid($uuid);

        // UUID tidak ditemukan di tabel manapun
        if (!$kode) {
            return view('content.verify.invalid', [
                'title' => 'Dokumen Tidak Valid',
                'message' => 'QR Code yang Anda pindai tidak terdaftar pada sistem RSIA atau sudah tidak berlaku.',
            ]);
        }

        $resolver = $this->registry->get($kode);
        $data = $resolver->findByUuid($uuid);

        // Bentuk jadi object supaya kompatibel dengan view lama yang pakai $dokumen->properti
        $dokumen = (object) $data;

        // Nomor dokumen: prefix beda-beda per jenis (GC, LAB, dst), diambil dari resolver
        $dokumen->nomor_dokumen = sprintf(
            '%d/%s/RSIA/%s',
            $dokumen->id,
            $resolver->nomorPrefix(),
            date('dmY', strtotime($dokumen->created_at)),
        );

        $dokumen->jenis_dokumen = $resolver->label();
        $dokumen->status = true;

        // View shell sama untuk semua jenis; kalau nanti perlu tampilan konten
        // yang beda per jenis, tinggal render partial $resolver->viewTemplate()
        // di dalam content.verify_dokumen, misal:
        // @include($dokumen->view_template ?? 'dokumen.partials.default', ['konten' => $dokumen->konten])
        $dokumen->view_template = $resolver->viewTemplate();

        return view('content.verify.valid', compact('dokumen'));
    }
}
