<?php

namespace App\Http\Action;

use App\Models\Tracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TrackerLogin
{
    public function handle(string $nik)
    {
        $tracker = new Tracker();
        $data = [
            'nip' => $nik,
            'tgl_login' => date('Y-m-d'),
            'jam_login' => date('H:i:s')
        ];
        Log::channel('authLog')
            ->info('Login Berhasil : ' . $nik . ' - ' . Carbon::parse($data['tgl_login'])->translatedFormat('d F Y') . ' ' . $data['jam_login']);

        return $tracker->create($data);
    }
}