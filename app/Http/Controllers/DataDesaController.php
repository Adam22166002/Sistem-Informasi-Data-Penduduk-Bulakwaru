<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function index()
    {
        return view('data-desa');
    }
}
