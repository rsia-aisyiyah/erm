<?php

namespace App\Http\Controllers;

use App\Models\HasilRadiologi;
use Illuminate\Http\Request;

class HasilRadiologiController extends Controller
{
    protected $track;
    protected $hasil;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->hasil = new HasilRadiologi();
    }
    function update(Request $request)
    {
        $data = [
            'hasil' => $request->hasil,
            'tgl_periksa' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        $clause = [
            'no_rawat' => $request->no_rawat
        ];
        $this->track->updateSql($this->hasil, $data, $clause);
        return $this->hasil->where($clause)->update($data);
    }
}
