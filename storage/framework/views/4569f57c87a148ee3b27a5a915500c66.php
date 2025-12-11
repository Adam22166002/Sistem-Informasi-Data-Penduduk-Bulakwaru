<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('sub-title', 'Selamat datang di panel admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header">Statistik</div>
    <div class="card-body">
      <p>Selamat datang, <?php echo e(auth()->user()->name); ?>!</p>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>