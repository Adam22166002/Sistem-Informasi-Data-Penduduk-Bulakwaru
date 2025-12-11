@extends('layouts.main')

@section('title', 'Profil Desa Bulakwaru')
@section('sub-title', 'Selamat Datang di Sistem Informasi Geografis SIDADU')

@section('content')
<div class="container-fluid p-0 position-relative mb-4">
    
    <!-- Hero Section -->
    <div class="card bg-gradient-primary-to-secondary text-white border-0 shadow-sm mb-4">
        <div class="card-body py-5 px-4 text-center">
            <h1 class="text-white-75 fw-bold mb-2">Desa Bulakwaru</h1>
            <p class="text-white-75 mb-0">Kecamatan Tarub, Kabupaten Tegal, Jawa Tengah</p>
        </div>
    </div>

    <!-- Informasi Umum -->
    <div class="row g-4 mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="text-white-75 card-header bg-gradient-primary-to-secondary fw-semibold">
                    <i class="text-white-75 fas fa-info-circle text-primary me-2"></i> Profil Singkat Desa
                </div>
                <div class="card-body">
                    <p class="mb-3 text-dark">
                        Desa Bulakwaru merupakan salah satu desa di Kecamatan Tarub, Kabupaten Tegal yang memiliki potensi di bidang pertanian dan industri rumahan.
                        Wilayah desa ini memiliki beberapa RT dan RW dengan sistem informasi penduduk yang terintegrasi melalui aplikasi <strong>SIDADU</strong> (Sistem Informasi Data Penduduk).
                    </p>
                    <p class="mb-0 text-dark">
                        Sistem ini memudahkan pemerintah desa dalam mengelola data kependudukan, memetakan wilayah, serta memberikan informasi geografis yang akurat bagi masyarakat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="text-white-75 card-header bg-gradient-primary-to-secondary fw-semibold">
                    <i class="text-white-75 fas fa-chart-pie text-primary me-2"></i> Statistik Umum
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted mb-0">Jumlah Penduduk</h6>
                            <h4 class="fw-bold text-dark">8.253 Jiwa</h4>
                        </div>
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted mb-0">Jumlah KK</h6>
                            <h4 class="fw-bold text-dark">2.452 KK</h4>
                        </div>
                        <i class="fas fa-home fa-2x text-success"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-0">Luas Wilayah</h6>
                            <h4 class="fw-bold text-dark">295.95 m2</h4>
                        </div>
                        <i class="fas fa-map-marked-alt fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur Pemerintahan -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="text-white-75 card-header bg-gradient-primary-to-secondary fw-semibold">
            <i class="text-white-75 fas fa-users-cog text-primary me-2"></i> Struktur Pemerintahan Desa
        </div>
        <div class="card-body">
            <div class="row g-4 text-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 border rounded bg-light h-100">
                        <img src="{{ asset('assets/img/struktur/lurah.jpg') }}" alt="Kepala Desa" class="img-fluid rounded-circle mb-2" style="width:110px; height:110px; object-fit:cover;">
                        <h6 class="fw-bold mb-0">MUHAMAD IZAM ZAMZAMI</h6>
                        <small class="text-muted">Kepala Desa</small>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 border rounded bg-light h-100">
                        <img src="{{ asset('assets/img/struktur/seketaris.jpg') }}" alt="Sekretaris Desa" class="img-fluid rounded-circle mb-2" style="width:110px; height:110px; object-fit:cover;">
                        <h6 class="fw-bold mb-0">FAOZAH</h6>
                        <small class="text-muted">Sekretaris Desa</small>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 border rounded bg-light h-100">
                        <img src="{{ asset('assets/img/struktur/tata-usaha.jpg') }}" alt="Kaur Tata-Usaha dan Umum" class="img-fluid rounded-circle mb-2" style="width:110px; height:110px; object-fit:cover;">
                        <h6 class="fw-bold mb-0">KHERUDIN</h6>
                        <small class="text-muted">Kaur Tata-Usaha dan Umum</small>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 border rounded bg-light h-100">
                        <img src="{{ asset('assets/img/struktur/perencanaan.jpg') }}" alt="Kaur Perencanaan" class="img-fluid rounded-circle mb-2" style="width:110px; height:110px; object-fit:cover;">
                        <h6 class="fw-bold mb-0">BANGUN SAPUTRA</h6>
                        <small class="text-muted">Kaur Perencanaan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lokasi Desa -->
    <div class="card shadow-sm border-0">
        <div class="text-white-75 card-header bg-gradient-primary-to-secondary fw-semibold">
            <i class="text-white-75 fas fa-map-marker-alt text-primary me-2"></i> Lokasi Desa Bulakwaru
        </div>
        <div class="card-body">
            <div id="mapDesa" style="height: 400px; width: 100%; border-radius: 10px;"></div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('mapDesa', {
        center: [-6.9326, 109.1938],
        zoom: 15
    });

    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0','mt1','mt2','mt3']
    }).addTo(map);

    L.marker([-6.9326, 109.1938]).addTo(map)
        .bindPopup("<b>Kantor Desa Bulakwaru</b><br>Jl. Raya Bulakwaru No. 10, Tarub.")
        .openPopup();
});
</script>
@endsection
