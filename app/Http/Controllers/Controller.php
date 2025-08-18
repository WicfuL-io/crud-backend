<?php

namespace App\Http\Controllers;

use App\Models\CCTV;

abstract class Controller
{
    public function index()
    {
        $cctvs = CCTV::all();
        return view('cctv.index', compact('cctvs'));
    }
}
