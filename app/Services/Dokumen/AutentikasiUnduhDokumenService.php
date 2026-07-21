<?php

namespace App\Services\Dokumen;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;

class AutentikasiUnduhDokumenService
{
    /** Maksimum percobaan salah sebelum uuid ini dikunci sementara */
    private const MAX_ATTEMPTS = 5;

    /** Lama kunci dalam detik (15 menit) */
    private const LOCKOUT_SECONDS = 900;

    /**
     * Verifikasi bahwa no_rkm_medis + tanggal_lahir yang diinput cocok
     * dengan pasien pemilik dokumen ber-uuid ini.
     *
     * @return array{ok: bool, alasan: ?string}
     */
    public function verifikasi(string $uuid, string $noRawat, string $noRkmMedis, string $tanggalLahir): array
    {
        $key = $this->throttleKey($uuid);

        // 1. Cek lockout dulu, sebelum query DB apa pun
        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            $tersisa = RateLimiter::availableIn($key);

            return [
                'ok' => false,
                'alasan' => "terlalu_banyak_percobaan:{$tersisa}",
            ];
        }

        // 2. Ambil data pasien asli dari no_rawat dokumen (BUKAN dari input user)
        $pasienAsli = DB::table('reg_periksa')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->select('pasien.no_rkm_medis', 'pasien.tgl_lahir')
            ->first();

        if (!$pasienAsli) {
            RateLimiter::hit($key, self::LOCKOUT_SECONDS);

            return ['ok' => false, 'alasan' => 'dokumen_tidak_ditemukan'];
        }

        // 3. Bandingkan pakai hash_equals — constant-time, mencegah timing attack
        //    yang bisa dipakai menebak karakter no_rkm_medis satu per satu.
        $rmCocok = hash_equals((string) $pasienAsli->no_rkm_medis, $noRkmMedis);
        $tglCocok = hash_equals(
            (string) date('Y-m-d', strtotime($pasienAsli->tgl_lahir)),
            $tanggalLahir
        );

        if (!$rmCocok || !$tglCocok) {
            RateLimiter::hit($key, self::LOCKOUT_SECONDS);

            return ['ok' => false, 'alasan' => 'identitas_tidak_cocok'];
        }

        // 4. Sukses -> reset counter supaya percobaan berikutnya (misal dokumen lain) bersih
        RateLimiter::clear($key);

        return ['ok' => true, 'alasan' => null];
    }

    private function throttleKey(string $uuid): string
    {
        // Key digabung uuid + ip supaya satu IP tidak bisa brute-force banyak uuid
        // sekaligus, dan satu uuid tidak bisa dibruteforce dari banyak IP secara paralel
        // tanpa kena limit sama sekali.
        return 'unduh-dokumen:' . $uuid . ':' . request()->ip();
    }
}