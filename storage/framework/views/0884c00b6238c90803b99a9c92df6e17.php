<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('sub-title', 'Selamat Datang di Sistem Informasi Geografis SIDADU'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="container-fluid">
        <div class="row align-items-center g-0">
            <div class="col-lg-5 col-md-12 hero-left p-5 text-white">
                <h6 class=" text-white mb-2 fw-semibold">Pemerintah Desa</h6>
                <h1 class="fw-bold mb-3 text-white"">BULAKWARU</h1>
                <div class="hero-badge mb-3">
                    <span>Desa Cerdas & Berdata</span>
                </div>
                <p class="mb-0">
                    Desa menjadi lebih efektif dan efisien dalam melakukan tugas dan fungsi
                    dengan baik dalam melayani masyarakat
                </p>
            </div>

            <div class="col-lg-7 col-md-12 hero-right">
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo e(asset('assets/img/backgrounds/hero-1.jpeg')); ?>" class="d-block w-100 hero-image" alt="Hero Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo e(asset('assets/img/backgrounds/hero-2.jpg')); ?>" class="d-block w-100 hero-image" alt="Hero Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo e(asset('assets/img/backgrounds/hero-3.jpg')); ?>" class="d-block w-100 hero-image" alt="Hero Image 3">
                        </div>
                    </div>

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-10">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card border-0 shadow">
            <div class="card-body d-flex align-items-center p-4">
                <div class="icon-wrapper bg-gradient-primary"><i class="bi bi-people"></i></div>
                <div class="ms-3">
                    <p class="text-muted mb-1 small fw-medium">Jumlah Penduduk</p>
                    <h3 class="mb-0 fw-bold counter" data-target="<?php echo e($jumlahPenduduk); ?>">0</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card border-0 shadow">
            <div class="card-body d-flex align-items-center p-4">
                <div class="icon-wrapper bg-gradient-secondary"><i class="bi bi-house-door"></i></div>
                <div class="ms-3">
                    <p class="text-muted mb-1 small fw-medium">Jumlah KK</p>
                    <h3 class="mb-0 fw-bold counter" data-target="<?php echo e($jumlahKK); ?>">0</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card border-0 shadow">
            <div class="card-body d-flex align-items-center p-4">
                <div class="icon-wrapper bg-gradient-info"><i class="bi bi-map"></i></div>
                <div class="ms-3">
                    <p class="text-muted mb-1 small fw-medium">Jumlah Rumah</p>
                    <h3 class="mb-0 fw-bold counter" data-target="<?php echo e($jumlahRumah); ?>">0</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card border-0 shadow">
            <div class="card-body d-flex align-items-center p-4">
                <div class="icon-wrapper bg-gradient-danger"><i class="bi bi-person-check"></i></div>
                <div class="ms-3">
                    <p class="text-muted mb-1 small fw-medium">Akun Terdaftar</p>
                    <h3 class="mb-0 fw-bold counter" data-target="<?php echo e($jumlahUser); ?>">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --hero-green-light: #294a88;
    --hero-green-dark: #132440;
    --gradient-primary: linear-gradient(135deg, #132440 0%, #294a88 100%);
    --gradient-secondary: linear-gradient(135deg, #2e5c96 0%, #6ea3d2 100%);
    --main-blue: #132440;
}

.hero-left {
    background: linear-gradient(135deg, var(--hero-green-light), var(--hero-green-dark));
    min-height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    position: relative;
}

.hero-left::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 10px;
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(255,255,255,0.25) 10%, transparent 70%);
    border-radius: 50%;
}

.hero-left h6 {
    font-size: 18px;
    letter-spacing: 0.5px;
}

.hero-left h1 {
    font-size: 48px;
    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);
}

.hero-badge span {
    display: inline-block;
    background: #ffff;
    color: #132440;
    padding: 10px 24px;
    border-radius: 30px;
    font-weight: 700;
}

.hero-left p {
    font-size: 16px;
    line-height: 1.6;
    max-width: 90%;
}

.hero-right {
    padding: 0;
}

.hero-image {
    width: 320px;
    height: 320px;
    object-fit: cover;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}

.carousel-indicators {
    bottom: 15px;
}

.carousel-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.5);
    border: none;
    margin: 0 5px;
    transition: all 0.3s ease;
}

.carousel-indicators .active {
    width: 28px;
    border-radius: 6px;
    background-color: #fff;
}

/* Statistic Cards */
.stat-card {
    border-radius: 16px;
    transition: 0.3s;
    background: #fff;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
}

.icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 24px;
}

.bg-gradient-primary { background: var(--gradient-primary); }
.bg-gradient-secondary { background: var(--gradient-secondary); }
.bg-gradient-info { background: #6ea3d2; }
.bg-gradient-danger { background: #dc3545; }

.counter {
    color: var(--main-blue);
}

/* Responsive */
@media (max-width: 992px) {
    .hero-left {
        border-radius: 20px 20px 0 0;
        text-align: center;
        padding: 3rem 2rem !important;
    }

    .hero-right {
        border-radius: 0 0 20px 20px;
    }

    .hero-left h1 {
        font-size: 36px;
    }

    .hero-left p {
        max-width: 100%;
    }

    .hero-badge span {
        font-size: 16px;
        padding: 8px 18px;
    }

    .hero-image {
        height: 300px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.counter').forEach(counter => {
        const target = +counter.dataset.target;
        let current = 0;
        const increment = target / 100;
        const update = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(update);
            } else counter.textContent = target;
        };
        update();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/home.blade.php ENDPATH**/ ?>