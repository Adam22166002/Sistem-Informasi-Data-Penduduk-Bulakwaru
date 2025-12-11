<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Rumah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahPenduduk = Penduduk::count();

        $jumlahKK = Penduduk::whereNotNull('no_kk')
            ->where('no_kk', '!=', '')
            ->distinct('no_kk')
            ->count('no_kk');

        $jumlahRumah = Rumah::count();
        $jumlahUser = User::where('status', 'aktif')
            ->orWhere('status', 1)
            ->count();
        return view('home', compact('jumlahPenduduk', 'jumlahKK', 'jumlahRumah', 'jumlahUser'));
    }
}
