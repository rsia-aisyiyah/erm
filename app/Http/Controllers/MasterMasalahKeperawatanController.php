<?php

namespace App\Http\Controllers;

use App\Models\MasterMasalahKeperawatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterMasalahKeperawatanController extends Controller
{
    protected $masalah;

    public function __construct()
    {
        $this->masalah = new MasterMasalahKeperawatan();
    }

    function get()
    {
        return $this->masalah->get();
    }

    function getDataTable()
    {
        $masalah = $this->masalah->get();
        return DataTables::of($masalah)->make(true);
    }
}
