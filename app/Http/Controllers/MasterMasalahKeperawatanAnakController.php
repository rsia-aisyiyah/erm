<?php

namespace App\Http\Controllers;

use App\Models\MasterMasalahKeperawatanAnak;
use Yajra\DataTables\DataTables;

class MasterMasalahKeperawatanAnakController extends Controller
{
    public function get()
    {
        $master = MasterMasalahKeperawatanAnak::all();
        return DataTables::of($master)->make(true);
    }
}
