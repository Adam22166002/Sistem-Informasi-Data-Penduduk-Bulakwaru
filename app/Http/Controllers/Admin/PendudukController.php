<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PendudukImport;
use App\Models\Penduduk;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function index()
    {
        $rumah = Rumah::withCount('penduduk')
            ->with(['penduduk' => function ($q) {
                $q->where('status_keluarga', 'Kepala Keluarga');
            }])
            ->get();

        return view('admin.penduduk.index', compact('rumah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rumah_id' => 'required|exists:rumah,id',
            'no_kk' => 'required|string|max:20',
            'nama' => 'required',
            'nik' => 'required|unique:penduduk,nik',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'pekerjaan' => 'required',
            'status_keluarga' => 'required'
        ]);

        $penduduk = Penduduk::create($request->all());

        return response()->json([
            'success' => true,
            'penduduk' => $penduduk
        ]);
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PendudukImport, $request->file('file'));

        return back()->with('success', 'Data penduduk berhasil diimpor!');
    }
    
    public function assignByKK(Request $request)
    {
        $request->validate([
            'rumah_id' => 'required|exists:rumah,id',
            'no_kk' => 'required|exists:penduduk,no_kk',
        ]);

        $penduduk = Penduduk::where('no_kk', $request->no_kk)->get();

        Penduduk::where('no_kk', $request->no_kk)
            ->update(['rumah_id' => $request->rumah_id]);

        return response()->json([
            'success' => true,
            'message' => 'Penduduk dari KK ' . $request->no_kk . ' berhasil ditautkan!',
            'penduduk' => $penduduk
        ]);
    }
}
