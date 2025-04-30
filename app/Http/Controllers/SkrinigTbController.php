<?php

namespace App\Http\Controllers;

use App\Models\SkrinigTb;
use Illuminate\Http\Request;

class SkrinigTbController extends Controller
{
    private $skrining;
    public function __construct()
    {
        $this->skrining = new SkrinigTb();
    }
    function create(Request $request)
    {
    }
}
