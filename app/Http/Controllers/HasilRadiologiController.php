<?php

namespace App\Http\Controllers;

use App\Models\GambarRadiologi;
use App\Models\HasilRadiologi;
use App\Models\PeriksaRadiologi;
use Illuminate\Http\Request;

class HasilRadiologiController extends Controller
{
    protected $track;
    protected $hasil;
    protected $periksa;
    protected $gambar;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->hasil = new HasilRadiologi();
        $this->periksa = new PeriksaRadiologi();
        $this->gambar = new GambarRadiologi();
    }
    function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'hasil' => $request->hasil,
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];
        $this->periksa->where($clause)->update([
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ]);
        $this->gambar->where($clause)->update([
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ]);

        $create =  $this->hasil->create($data);
        if ($create) {
            $this->track->insertSql($this->hasil, $data, $clause);
        }
    }
    function update(Request $request)
    {
        $data = [
            'hasil' => $request->hasil,
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];
        $this->periksa->where($clause)->update([
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ]);
        $this->gambar->where($clause)->update([
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s')
        ]);
        $update = $this->hasil->where($clause)->update($data);
        if ($update) {
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
