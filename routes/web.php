<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ImportExportController as AdminImportExportController;
use App\Http\Controllers\Admin\PendudukController as AdminPendudukController;
use App\Http\Controllers\Admin\RumahController as AdminRumahController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\ProfileDesaController;
use App\Models\Rumah;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Halaman utama (home)
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/peta-desa', [PetaController::class, 'index'])->name('peta');
Route::get('/profil-desa', [ProfileDesaController::class, 'index'])->name('profil-desa');
Route::get('/data-desa', [DataDesaController::class, 'index'])->name('data');
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::get('/peta-desa', [PetaController::class, 'index'])->name('peta');

// 🔹 Redirect root ke home
Route::get('/', function () {
    return redirect('/home');
});
// 🔹 Profil untuk semua user login
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 API GeoJSON Rumah (untuk peta Leaflet)
Route::get('/api/rumah/geojson', function () {
    $data = Rumah::select('id', 'kode_rumah', 'alamat', 'rt', 'rw', 'latitude', 'longitude', 'keterangan')->get();

    $features = $data->map(function ($r) {
        return [
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
        ];
    });

    return response()->json(['type' => 'FeatureCollection', 'features' => $features]);
})->middleware('auth')->name('api.rumah.geojson');

Route::get('/api/geojson', function () {
    $data = Rumah::with('penduduk:id,rumah_id,nama,nik,jenis_kelamin,status_keluarga')
        ->select('id', 'kode_rumah', 'alamat', 'rt', 'rw', 'latitude', 'longitude')
        ->get();

    $features = $data->map(function ($r) {
        return [
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
                'jumlah_penduduk' => $r->penduduk->count(),
                'penduduk' => $r->penduduk->map(function ($p) {
                    return [
                        'nama' => $p->nama,
                        'nik' => $p->nik,
                        'jenis_kelamin' => $p->jenis_kelamin,
                        'status_keluarga' => $p->status_keluarga,
                    ];
                })
            ],
        ];
    });

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features,
    ]);
})->middleware('auth')->name('api.geojson');

Route::get('/api/geojson/filter', [PetaController::class, 'geojson'])->middleware('auth');
Route::get('/api/rumah/detail/{id}', [PetaController::class, 'detail'])->middleware('auth');


// 🔹 Grup route untuk ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::patch('/admin/users/status/{user}', [UserController::class, 'updateStatus'])
        ->name('users.updateStatus');

    Route::resource('admin/users', UserController::class)->except(['create', 'show']);
    Route::post('admin/users/import', [UserController::class, 'import'])->name('users.import');

    Route::resource('admin/rumah', AdminRumahController::class);

    Route::resource('admin/penduduk', AdminPendudukController::class);
    Route::post('admin/penduduk/assign-kk', [AdminPendudukController::class, 'assignByKK'])->name('penduduk.assignByKK');
    Route::post('admin/penduduk/import', [AdminImportExportController::class, 'import'])->name('penduduk.import');
    Route::get('admin/penduduk/export', [AdminImportExportController::class, 'export'])->name('penduduk.export');
});

// 🔹 Auth routes (Laravel Breeze)
require __DIR__ . '/auth.php';
