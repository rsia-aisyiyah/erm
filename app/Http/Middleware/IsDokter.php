<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('pegawai')->departemen != 'SPS' || session()->get('pegawai')->jnj_jabatan != 'DIRU' || session()->get('pegawai')->departemen != 'DM7' || !session()->get('pegawai')->dokter) {
            return '/';
        }
        return $next($request);
    }
}
