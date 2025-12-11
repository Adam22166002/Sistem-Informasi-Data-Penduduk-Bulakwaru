<?php $__env->startSection('title', 'Login SIDADU'); ?>

<?php $__env->startSection('auth'); ?>
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100">

    <div class="text-center mb-4">
        <img src="<?php echo e(asset('assets/img/logo-sidadu.jpg')); ?>" alt="Logo SIDADU" style="height: 50px;">
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
            <a href="<?php echo e(route('google.login')); ?>"
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

        
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="text" name="email" placeholder="Contoh: sidadu@mail.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label small text-muted mb-0">Password</label>
                    <a href="<?php echo e(route('password.request')); ?>" class="small text-decoration-none text-primary">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/auth/login.blade.php ENDPATH**/ ?>