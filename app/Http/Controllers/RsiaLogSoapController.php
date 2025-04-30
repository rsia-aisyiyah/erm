<?php

namespace App\Http\Controllers;

use App\Models\RsiaLogSoap;
use Illuminate\Http\Request;

class RsiaLogSoapController extends Controller
{
    //
    protected $log;
    protected $track;
    public function __construct()
    {
        $this->log = new RsiaLogSoap();
        $this->track = new TrackerSqlController();
    }

    function insert($key = [], $aksi)
    {
        $dataDefault = [
            'waktu' => date('Y-m-d H:i:s'),
            'aksi' => $aksi,
            'nip' => session()->get('pegawai')->nik
        ];

        $data = array_merge($dataDefault, $key);
        $this->track->insertSql($this->log, $data);
        return $this->log->create($data);
    }
}
