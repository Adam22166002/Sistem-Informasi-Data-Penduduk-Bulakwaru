<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RumahController extends Controller
{
    public function index()
    {
        return view('admin.rumah.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_rumah' => 'required|unique:rumah,kode_rumah',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $data = Rumah::create($validated + ['created_by' => Auth::id()]);

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function edit($id)
    {
        $rumah = Rumah::findOrFail($id);
        return response()->json($rumah);
    }

    public function update(Request $request, $id)
    {
        $rumah = Rumah::findOrFail($id);

        $validated = $request->validate([
            'kode_rumah' => 'required|unique:rumah,kode_rumah,' . $id,
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $rumah->update($validated);

        return response()->json(['success' => true, 'data' => $rumah]);
    }

    public function destroy($id)
    {
        Rumah::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
