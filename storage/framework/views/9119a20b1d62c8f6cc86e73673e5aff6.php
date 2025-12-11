<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIDADU - <?php echo $__env->yieldContent('title', 'Sistem Informasi Data Penduduk Desa Bulakwaru'); ?></title>

    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon.jpg')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        input[type="radio"]:checked {
            accent-color: #132440;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #ffffff !important;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                margin-top: 10px;
            }

            .nav-item {
                margin-bottom: 4px;
            }
        }

        .nav-link {
            font-weight: 500;
            color: #132440 !important;
            border: 2px solid transparent;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-right: 8px;
            padding: 6px 14px;
        }

        .active-nav {
            border: 2px solid #132440;
            background-color: #132440;
            color: #fff !important;
        }

        .nav-link.active,
        .nav-link:hover,
        .nav-link.active:hover {
            color: #132440 !important;
            background-color: #f8f9fa !important;
            border: 2px solid #132440 !important;
        }

        footer {
            position: relative;
            background: #132440;
            color: #fff;
            padding: 40px 0 20px;
            font-size: 0.95rem;
        }

        footer .footer-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #fff;
        }

        footer .footer-links {
            list-style: none;
            padding: 0;
        }

        footer .footer-links li {
            margin-bottom: 8px;
        }

        footer .footer-links a {
            text-decoration: none;
            color: #dcdcdc;
            transition: 0.2s;
        }

        footer .footer-links a:hover {
            color: #fff;
            padding-left: 4px;
        }

        footer .social-links a {
            display: inline-block;
            color: #fff;
            font-size: 1.2rem;
            margin-right: 10px;
            transition: 0.3s;
        }

        footer .social-links a:hover {
            color: #ffd700;
        }

        footer .footer-bottom {
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 30px;
            padding-top: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="nav-fixed">
    <!-- Navbar -->
    <nav class="topnav navbar navbar-expand-lg shadow-sm navbar-light bg-white py-2">
        <div class="container">
            <!-- Logo & Brand -->
            <a class="navbar-brand d-flex align-items-center mr-10" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('assets/img/logo-sidadu.jpg')); ?>" alt="Logo SIDADU"
                    style="height: 40px; width: auto; object-fit: contain; margin-right: 3px;">
                <span style="font-size: 1.5rem; font-weight: 700; font-style: italic; color: #132440; letter-spacing: 2px;">
                    SIDADU
                </span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Menu utama -->
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item mx-1">
                        <a class="nav-link d-flex flex-column align-items-center <?php echo e(request()->is('home') ? 'active-nav' : ''); ?>" href="<?php echo e(route('home')); ?>">
                            <img src="<?php echo e(asset('assets/img/menu/beranda.png')); ?>" alt="Beranda" style="height: 15px;">
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link d-flex flex-column align-items-center <?php echo e(request()->is('profil-desa') ? 'active-nav' : ''); ?>" href="<?php echo e(route('profil-desa')); ?>">
                            <img src="<?php echo e(asset('assets/img/menu/ppdesa.png')); ?>" alt="Profil Desa" style="height: 15px;">
                            <span>Profil Desa</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link d-flex flex-column align-items-center px-3 <?php echo e(request()->is('peta') ? 'active-nav' : ''); ?>" href="<?php echo e(route('peta')); ?>">
                            <img src="<?php echo e(asset('assets/img/menu/map.png')); ?>" alt="Peta" style="height: 15px;">
                            <span>Peta</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link d-flex flex-column align-items-center px-3 <?php echo e(request()->is('data*') ? 'active-nav' : ''); ?>" href="<?php echo e(route('data')); ?>">
                            <img src="<?php echo e(asset('assets/img/menu/angka.png')); ?>" alt="Data" style="height: 15px;">
                            <span>Data</span>
                        </a>
                    </li>
                </ul>

                <!-- Right Section -->
                <ul class="navbar-nav align-items-center ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                    <!-- Notifikasi -->
                    <li class="nav-item dropdown me-3 d-none d-sm-block">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
                            href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <i data-feather="bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownAlerts">
                            <h6 class="dropdown-header dropdown-notifications-header">
                                <i class="me-2" data-feather="bell"></i> Notifikasi
                            </h6>
                            <a class="dropdown-item dropdown-notifications-footer" href="#!">Lihat semua</a>
                        </div>
                    </li>

                    <!-- Dropdown user -->
                    <li class="nav-item dropdown no-caret dropdown-user">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="img-fluid" src="<?php echo e(asset('assets/img/illustrations/profiles/profile.jpg')); ?>" alt="User" style="height: 42px; width: 42px;" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up">
                            <h6 class="dropdown-header d-flex align-items-center">
                                <img class="dropdown-user-img" src="<?php echo e(asset('assets/img/illustrations/profiles/profile.jpg')); ?>" />
                                <div class="dropdown-user-details ms-2">
                                    <div class="dropdown-user-details-name"><?php echo e(auth()->user()->name); ?></div>
                                    <div class="dropdown-user-details-email text-muted small"><?php echo e(auth()->user()->email); ?></div>
                                </div>
                            </h6>
                            <div class="dropdown-divider"></div>
                            <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="dropdown-item">
                                <i data-feather="home" class="me-2"></i> Dashboard
                            </a>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role === 'user'): ?>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                <i data-feather="users" class="me-2"></i> Setting Profil
                            </a>
                            <?php endif; ?>
                            <?php endif; ?>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <i data-feather="log-out" class="me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <?php else: ?>
                    <!-- Jika belum login -->
                    <li class="nav-item d-flex align-items-center gap-2">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-md px-4">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="mt-4">
        <div class="container-xl px-4 mt-10">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <a class="navbar-brand d-flex align-items-center mb-4" href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(asset('assets/img/footer-logo.png')); ?>" alt="Logo SIDADU"
                            style="height: 40px; width: auto; object-fit: contain; margin-right: 3px;">
                        <span style="font-size: 1.8rem; font-weight: 700; font-style: italic; color: #ffffff; letter-spacing: 2px;">
                            SIDADU
                        </span>
                    </a>
                    <p class="text-white-50">
                        Sistem Informasi Geografis untuk pengelolaan dan visualisasi data spasial secara interaktif dan real-time.
                    </p>
                    <div class="social-links mt-3">
                        <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.twitter.com/"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-title">Menu</h5>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(url('/home')); ?>"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                        <li><a href="<?php echo e(url('/profil-desa')); ?>"><i class="bi bi-chevron-right"></i> Profil Desa</a></li>
                        <li><a href="<?php echo e(url('/peta')); ?>"><i class="bi bi-chevron-right"></i> Peta</a></li>
                        <li><a href="<?php echo e(url('/data')); ?>"><i class="bi bi-chevron-right"></i> Data</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-title">Informasi</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Panduan Pengguna</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> FAQ</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Kebijakan Privasi</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Kontak</h5>
                    <ul class="footer-links">
                        <li>
                            <i class="bi bi-geo-alt"></i> Jl.Anggrek, Bulakwaru, Tarub, Tegal-Jawa Tengah<br>
                        </li>
                        <li><i class="bi bi-envelope"></i> info@sidadu.com</li>
                        <li><i class="bi bi-telephone"></i> +62 271 123456</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">
                    &copy; <?php echo e(date('M, Y')); ?> SIDADU. All rights reserved.
                    Made with by Developer Bulakwaru
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
    <script src="<?php echo e(asset('js/litepicker.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html><?php /**PATH D:\Project-Programmer\project-ta\resources\views/layouts/main.blade.php ENDPATH**/ ?>