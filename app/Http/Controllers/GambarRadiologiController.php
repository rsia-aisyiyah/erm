<?php

namespace App\Http\Controllers;

use App\Models\GambarRadiologi;
use Illuminate\Http\Request;

class GambarRadiologiController extends Controller
{
    protected $gambar;
    protected $track;
    public function __construct()
    {
        $this->gambar = new GambarRadiologi();
        $this->track = new TrackerSqlController();
    }

    public function updateDateTime($clause = [], $data = [])
    {
        $update = $this->gambar->where($clause)->update($data);
        if ($update) {
            $this->track->updateSql($this->gambar, $data, $clause);
        }
    }
}
