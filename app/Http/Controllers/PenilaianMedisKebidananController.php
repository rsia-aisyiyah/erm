<?php

namespace App\Http\Controllers;

use App\Models\PenilaianMedisRalanKandungan;
use Illuminate\Http\Request;

class PenilaianMedisKebidananController extends Controller
{
    private $penilaian, $dataPenliaian;
    public function __construct()
    {
        $this->penilaian = new PenilaianMedisRalanKandungan();
        $this->dataPenliaian = $this->penilaian->semua();
    }
    public function index()
    {
        $dataPenilaian = $this->dataPenliaian;

        return $dataPenilaian->get();
    }
}
