@extends('layouts.guest')

@section('title', 'Login SIDADU')

@section('auth')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100">

    <div class="text-center mb-4">
        <img src="{{ asset('assets/img/logo-sidadu.jpg') }}" alt="Logo SIDADU" style="height: 50px;">
    </div>

    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 16px; border: none;">
        <h5 class="text-center mb-2 fw-semibold">Masuk ke SIDADU</h5>
        <p class="text-center text-muted small mb-4">
            Belum punya akun SIDADU? 
            <a href="https://wa.me/6285363783837?text=Halo%20Admin,%20saya%20ingin%20membuat%20akun%20SIDADU%20dengan%20kode%20akses." 
            class="text-decoration-none text-success" target="_blank">
            Hubungi Admin!
            </a>
        </p>

        <div class="d-grid mb-3">
            <a href="{{ route('google.login') }}"
            class="btn btn-outline-light border d-flex align-items-center justify-content-center gap-2"
            style="border-radius: 10px; border-color: #ddd;">
                <img src="https://developers.google.com/identity/images/g-logo.png" 
                    alt="Google" style="width:18px">
                <span class="fw-semibold text-primary">Masuk dengan Google</span>
            </a>
        </div>

        <div class="d-flex align-items-center">
            <hr class="flex-grow-1">
            <span class="mx-2 text-muted small">atau</span>
            <hr class="flex-grow-1">
        </div>

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="text" name="email" placeholder="Contoh: sidadu@mail.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label small text-muted mb-0">Password</label>
                    <a href="{{ route('password.request') }}" class="small text-decoration-none text-primary">
                        Lupa Password
                    </a>
                </div>

                <div class="input-group">
                    <input id="password" class="form-control" type="password" name="password" placeholder="Masukkan Password" required>
                    <span class="input-group-text bg-white border-start-0">
                        <i data-feather="eye-off" class="text-muted" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="access_code" id="access_code" class="form-control" placeholder="Masukan Kode Akses" required>
                <span class="input-group-text bg-white border-start-0">
                    <i data-feather="lock" class="text-muted" style="cursor: pointer;"></i>
                </span>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="border-radius: 10px;">Masuk</button>
            </div>
        </form>
    </div>
</div>
@endsection