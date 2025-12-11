<?php

namespace App\Http\Controllers\Admin;

use App\Imports\PendudukImport;
use App\Exports\PendudukExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new PendudukImport, $request->file('file'));
        return back()->with('success', 'Data penduduk berhasil diimport!');
    }

    public function export()
    {
        return Excel::download(new PendudukExport, 'penduduk.xlsx');
    }
}
