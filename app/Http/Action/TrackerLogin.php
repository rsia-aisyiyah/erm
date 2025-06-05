<?php

namespace App\Http\Action;

use App\Models\Tracker;


class TrackerLogin
{
    public function handle(string $nik)
    {
        $tracker = new Tracker();
        return $tracker->create([
            'nip' => $nik,
            'tgl_login' => date('Y-m-d'),
            'jam_login' => date('H:i:s')
        ]);
    }
}