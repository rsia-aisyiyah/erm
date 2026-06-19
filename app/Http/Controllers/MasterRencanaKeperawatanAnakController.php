<?php

namespace App\Http\Controllers;

use App\Models\MasterRencanaKeperawatanAnak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterRencanaKeperawatanAnakController extends Controller
{
    public function get(Request $request)
    {
        $kode_masalah = $request->kode_masalah;
        $kode_rencana = $request->kode_rencana;

        $master = MasterRencanaKeperawatanAnak::query();

        if ($kode_rencana) {
            $master = $master->where('kode_rencana', $kode_rencana);
        } elseif ($kode_masalah) {
            $master = $master->whereIn('kode_masalah', $kode_masalah);
        } else {
            $master = [];
        }

        if ($request->has('search') && $request->get('search')['value']) { {
                $master = $master->whereHas('master', function ($query) use ($request) {
                    $query->where('nm_masalah', 'like', '%' . $request->get('search')['value'] . '%');
                });
            }
        }
        return DataTables::of($master)->make(true);
    }
}
