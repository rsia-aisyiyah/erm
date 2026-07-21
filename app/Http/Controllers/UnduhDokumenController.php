<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifikasiUnduhDokumenRequest;
use App\Services\Dokumen\AutentikasiUnduhDokumenService;
use App\Services\Dokumen\DokumenResolverRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class UnduhDokumenController extends Controller
{
    public function __construct(
        private DokumenResolverRegistry $registry,
        private AutentikasiUnduhDokumenService $autentikasi,
    ) {
    }

    /**
     * POST /dokumen/verifikasi-unduh
     * Dipanggil dari modal via fetch/AJAX. Body: uuid, no_rkm_medis, tgl_lahir.
     * Tidak langsung stream file — hanya balas JSON berisi link unduh
     * sekali pakai kalau identitas cocok.
     */
    public function verifikasi(VerifikasiUnduhDokumenRequest $request)
    {


        $uuid = $request->input('uuid');
        $kode = $this->registry->findKodeByUuid($uuid);

        $form = $request->validated();

        if (!$kode) {
            return response()->json(['ok' => false, 'pesan' => 'Dokumen tidak ditemukan.'], 404);
        }

        $resolver = $this->registry->get($kode);
        $dokumen = $resolver->findByUuid($uuid);

        $hasil = $this->autentikasi->verifikasi(
            uuid: $uuid,
            noRawat: $dokumen['no_rawat'],
            noRkmMedis: $form['no_rkm_medis'],
            tanggalLahir: $form['tgl_lahir'],
        );

        if (!$hasil['ok']) {
            $pesan = str_starts_with($hasil['alasan'] ?? '', 'terlalu_banyak_percobaan')
                ? 'Terlalu banyak percobaan gagal. Coba lagi dalam beberapa menit.'
                : 'Nomor Rekam Medis atau Tanggal Lahir tidak sesuai.';

            return response()->json(['ok' => false, 'pesan' => $pesan], 422);
        }

        // Link unduh sekali pakai, kadaluarsa 5 menit, tidak butuh input identitas lagi.
        $urlUnduh = URL::temporarySignedRoute(
            'dokumen.unduh.file',
            now()->addMinutes(5),
            ['uuid' => $uuid]
        );
        // return $this->file($request, $uuid);
        // return redirect($urlUnduh);

        return response()->json(['ok' => true, 'url' => $urlUnduh]);
    }

    /**
     * GET /dokumen/{uuid}/unduh-file  (route name: dokumen.unduh.file)
     * Middleware 'signed' bawaan Laravel otomatis menolak request kalau
     * signature tidak valid atau sudah lewat waktu — jadi endpoint ini
     * TIDAK bisa diakses langsung tanpa lewat verifikasi() di atas dulu.
     */
    public function file(Request $request, string $uuid)
    {
        $kode = $this->registry->findKodeByUuid($uuid);
        abort_unless($kode, 404);

        $dokumen = $this->registry->get($kode)->findByUuid($uuid);
        $resolver = $this->registry->get($kode);
        abort_unless($dokumen && Storage::disk($resolver->storage())->exists($dokumen['file']), 404);
        return Storage::disk($resolver->storage())->download(
            $dokumen['file'],
            $this->namaFileUnduhan($resolver->nomorPrefix(), $dokumen)
        );
    }
    private function namaFileUnduhan(string $prefix, array $dokumen): string
    {
        $tahun = date('Y', strtotime($dokumen['created_at']));
        $nomorUrut = str_pad((string) $dokumen['id'], 6, '0', STR_PAD_LEFT);

        return "{$prefix}-RSIA-{$tahun}-{$nomorUrut}.pdf";
    }
}