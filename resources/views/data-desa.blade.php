@extends('layouts.main')

@section('title', 'Data Desa Bulakwaru')
@section('sub-title', 'Informasi Statistik dan Data Wilayah Desa Bulakwaru')

@section('content')
<div class="container-fluid p-0 position-relative mb-4">

    <!-- Header Section -->
    <div class="card bg-gradient-primary-to-secondary text-white-75 border-0 shadow-sm mb-4">
        <div class="card-body py-4 px-4 text-center">
            <h3 class="text-white-75 fw-bold mb-2">Data Desa Bulakwaru</h3>
            <p class="text-white-75 mb-0">Informasi kependudukan, wilayah, dan fasilitas umum desa Bulakwaru</p>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-top-primary h-100 text-center p-3">
                <div class="text-primary mb-2">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <h6 class="text-muted mb-1">Jumlah Penduduk</h6>
                <h4 class="fw-bold mb-0">8.253</h4>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-top-primary h-100 text-center p-3">
                <div class="text-success mb-2">
                    <i class="fas fa-home fa-2x"></i>
                </div>
                <h6 class="text-muted mb-1">Jumlah KK</h6>
                <h4 class="fw-bold mb-0">2.452</h4>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-top-primary h-100 text-center p-3">
                <div class="text-warning mb-2">
                    <i class="fas fa-map-marked-alt fa-2x"></i>
                </div>
                <h6 class="text-muted mb-1">Luas Wilayah</h6>
                <h4 class="fw-bold mb-0">295.95 m2</h4>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-top-primary h-100 text-center p-3">
                <div class="text-danger mb-2">
                    <i class="fas fa-layer-group fa-2x"></i>
                </div>
                <h6 class="text-muted mb-1">Jumlah RT / RW</h6>
                <h4 class="fw-bold mb-0">31 / 3</h4>
            </div>
        </div>
    </div>

    <!-- Data Wilayah -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-gradient-primary-to-secondary text-white-75 fw-semibold">
            <i class="text-white-75 fas fa-map text-primary me-2"></i> Data Wilayah Administratif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Dusun</th>
                            <th>Jumlah RT</th>
                            <th>Jumlah RW</th>
                            <th>Jumlah KK</th>
                            <th>Jumlah Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dusun 1</td>
                            <td>10</td>
                            <td>1</td>
                            <td>833</td>
                            <td>2.831</td>
                        </tr>
                        <tr>
                            <td>Dusun 2</td>
                            <td>12</td>
                            <td>1</td>
                            <td>851</td>
                            <td>2.851</td>
                        </tr>
                        <tr>
                            <td>Dusun 3</td>
                            <td>9</td>
                            <td>1</td>
                            <td>768</td>
                            <td>2.571</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Fasilitas Umum -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-gradient-primary-to-secondary text-white-75 fw-semibold">
            <i class="text-white-75 fas fa-school text-primary me-2"></i> Fasilitas Umum
        </div>
        <div class="card-body">
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <i class="fas fa-school fa-2x text-primary mb-2"></i>
                        <h6 class="fw-semibold mb-1">Sekolah</h6>
                        <p class="text-dark small mb-0">7 Unit</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <i class="fas fa-mosque fa-2x text-success mb-2"></i>
                        <h6 class="fw-semibold mb-1">Masjid/Mushola</h6>
                        <p class="text-dark small mb-0">23 Unit</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <i class="fas fa-clinic-medical fa-2x text-danger mb-2"></i>
                        <h6 class="fw-semibold mb-1">Posyandu/Puskesmas</h6>
                        <p class="text-dark small mb-0">3 Unit</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <i class="fas fa-warehouse fa-2x text-warning mb-2"></i>
                        <h6 class="fw-semibold mb-1">Balai Desa</h6>
                        <p class="text-dark small mb-0">1 Unit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection