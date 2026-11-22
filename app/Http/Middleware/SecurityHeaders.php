<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityHeaders
{
    /**
     * Tambahkan HTTP Security Headers standar aplikasi Rekam Medis (ERM).
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cegah clickjacking (tetap izinkan iframe dari origin yang sama untuk preview cetak PDF)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN', false);

        // Cegah MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff', false);

        // Batasi informasi Referer keluar
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin', false);

        // Batasi fitur browser sensitif (izinkan camera dari origin sendiri untuk scan/upload)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=(self)', false);

        // Untuk request terautentikasi berisi HTML/JSON rekam medis (PHI),
        // cegah browser menyimpan cache agar aman di komputer bersama (Poli/UGD/Bangsal)
        if (Auth::check()) {
            $contentType = strtolower((string) $response->headers->get('Content-Type', ''));
            $isHtmlOrJson = $contentType === ''
                || str_contains($contentType, 'text/html')
                || str_contains($contentType, 'application/json');

            if ($isHtmlOrJson) {
                $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, private, max-age=0');
                $response->headers->set('Pragma', 'no-cache');
                $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
            }
        }

        return $response;
    }
}
