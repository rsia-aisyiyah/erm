<?php

namespace App\Http\Controllers;

use App\Models\GambarRadiologi;
use App\Models\HasilRadiologi;
use App\Models\PeriksaRadiologi;
use App\Models\PermintaanRadiologi;
use Illuminate\Http\Request;

class HasilRadiologiController extends Controller
{
    protected $track;
    protected $hasil;
    protected $periksa;
    protected $gambar;
    protected $permintaan;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->hasil = new HasilRadiologi();
        $this->periksa = new PeriksaRadiologiController();
        $this->gambar = new GambarRadiologiController();
        $this->permintaan = new PermintaanRadiologiController();
    }
    function create(Request $request)
    {
        $dateTime = [
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ];
        $data = [
            'no_rawat' => $request->no_rawat,
            'hasil' => $request->hasil,
            'tgl_periksa' => $dateTime['tgl_periksa'],
            'jam' => $dateTime['jam'],
        ];
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];
        $clausePermintaan = [
            'noorder' => $request->noorder
        ];


        $create =  $this->hasil->create($data);

        if ($create) {
            $this->periksa->updateDateTime($clause, $dateTime);
            $this->gambar->updateDateTime($clause, $dateTime);
            $this->permintaan->updateDateTime($clausePermintaan, [
                'tgl_hasil' => $dateTime['tgl_periksa'],
                'jam_hasil' => $dateTime['jam'],
            ]);
            $this->track->insertSql($this->hasil, $data, $clause);
        }
    }
    function update(Request $request)
    {
        $dateTime = [
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ];
        $data = [
            'hasil' => $request->hasil,
            'tgl_periksa' => $dateTime['tgl_periksa'],
            'jam' => $dateTime['jam'],
        ];
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];
        $clausePermintaan = [
            'noorder' => $request->noorder
        ];

        $update = $this->hasil->where($clause)->update($data);
        if ($update) {
            $this->periksa->updateDateTime($clause, $dateTime);
            $this->gambar->updateDateTime($clause, $dateTime);
            $this->permintaan->updateDateTime($clausePermintaan, [
                'tgl_hasil' => $dateTime['tgl_periksa'],
                'jam_hasil' => $dateTime['jam'],
            ]);
            $this->track->updateSql($this->hasil, $data, $clause);
        }
    }
    function get(Request $request)
    {
        $hasil = $this->hasil->with('periksaRadiologi.petugas');
        if ($request->tgl_periksa) {
            return $hasil->where([
                'no_rawat' => $request->no_rawat,
                'tgl_periksa' => $request->tgl_periksa,
                'jam' => $request->jam,
            ])->first();
        } else {
            return $hasil->where('no_rawat', $request->no_rawat)->get();
        }
    }
}
