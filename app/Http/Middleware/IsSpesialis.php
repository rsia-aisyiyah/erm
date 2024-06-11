<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSpesialis
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
        if (
            auth()->guest() || auth()->user()->username != 'admin' ||
            session()->get('pegawai')->nik == 'direksi' ||
            session()->get('pegawai')->jbtn == 'Dokter Spesialis Radiologi' ||
            session()->get('pegawai')->departemen == 'RAD' ||
            session()->get('pegawai')->departemen == 'CSM'
        ) {
            return redirect('/');
        }
        return $next($request);
    }
}
