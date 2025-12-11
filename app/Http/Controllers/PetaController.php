<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        return view('peta');
    }
    public function geojson(Request $request)
    {
        $query = Rumah::select('id', 'kode_rumah', 'alamat', 'rt', 'rw', 'latitude', 'longitude');

        if ($request->rt) $query->where('rt', $request->rt);
        if ($request->rw) $query->where('rw', $request->rw);

        if ($request->search) {
            $s = $request->search;
            $query->whereHas('penduduk', function ($q) use ($s) {
                $q->where('nama', 'like', "%$s%")
                    ->orWhere('nik', 'like', "%$s%")
                    ->orWhere('no_kk', 'like', "%$s%");
            });
        }

        $data = $query->limit(500)->get();

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $data->map(fn($r) => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$r->longitude, (float)$r->latitude],
                ],
                'properties' => [
                    'id' => $r->id,
                    'kode_rumah' => $r->kode_rumah,
                    'alamat' => $r->alamat,
                    'rt' => $r->rt,
                    'rw' => $r->rw,
                ],
            ])
        ]);
    }

    public function detail($id)
    {
        $rumah = Rumah::with('penduduk')->findOrFail($id);

        return response()->json([
            'kode_rumah' => $rumah->kode_rumah,
            'alamat' => $rumah->alamat,
            'rt' => $rumah->rt,
            'rw' => $rumah->rw,
            'penduduk' => $rumah->penduduk->map(fn($p) => [
                'nama' => $p->nama,
                'nik' => $p->nik,
                'jenis_kelamin' => $p->jenis_kelamin,
                'status_keluarga' => $p->status_keluarga,
            ]),
        ]);
    }
}
