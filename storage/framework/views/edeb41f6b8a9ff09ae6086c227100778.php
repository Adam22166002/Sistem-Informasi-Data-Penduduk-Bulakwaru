

<?php $__env->startSection('title', 'Manajemen User'); ?>
<?php $__env->startSection('sub-title', 'Mengelola Data User SIDADU Bulakwaru'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
                <div class="d-flex gap-2">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importUserModal">
                        <i data-feather="upload" class="me-1"></i> Import
                    </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                        <i data-feather="trash-2" class="me-1"></i> Hapus
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i data-feather="plus" class="me-1"></i> Tambah
                    </button>
                </div>
            </div>
            <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Kode Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <select class="form-select form-select-sm user-status"
                                        data-id="<?php echo e($user->id); ?>">
                                    <option value="active" <?php echo e($user->status == 'active' ? 'selected' : ''); ?>>Active</option>
                                    <option value="inactive" <?php echo e($user->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                </select>
                            </td>
                            <td><?php echo e(ucfirst($user->role)); ?></td>
                            <td><?php echo e($user->access_code); ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn"
                                    data-id="<?php echo e($user->id); ?>"
                                    data-name="<?php echo e($user->name); ?>"
                                    data-email="<?php echo e($user->email); ?>"
                                    data-role="<?php echo e($user->role); ?>"
                                    data-access_code="<?php echo e($user->access_code); ?>"
                                    data-status="<?php echo e($user->status); ?>">
                                    Edit
                                </button>
                                <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline deleteForm">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- modal import -->
        <div class="modal fade" id="importUserModal" tabindex="-1" aria-labelledby="importUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('users.import')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importUserModalLabel">Import Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Pilih File Excel (.xlsx/.xls)</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Import User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="addUserModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="<?php echo e(route('users.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Kode Akses</label>
                                <input type="text" name="access_code" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="editUserModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" id="editForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" id="editEmail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password Baru (Kosongkan jika tidak ingin diubah)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" id="editRole" class="form-select" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Kode Akses</label>
                                <input type="text" name="access_code" id="editAccessCode" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" id="editStatus" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const table = document.querySelector('#datatablesSimple tbody');

    // Edit User
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('editBtn')) {
            const btn = e.target;

            document.getElementById('editForm').action = `/admin/users/${btn.dataset.id}`;
            document.getElementById('editName').value = btn.dataset.name;
            document.getElementById('editEmail').value = btn.dataset.email;
            document.getElementById('editRole').value = btn.dataset.role;
            document.getElementById('editAccessCode').value = btn.dataset.access_code;
            document.getElementById('editStatus').value = btn.dataset.status;

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }
    });

    // Delete User
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.deleteForm');
        if (btn) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin hapus user ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.submit();
                }
            });
        }
    });

    // Change Status (FITS DATATABLE!)
    table.addEventListener('change', function(e) {
        if (e.target.classList.contains('user-status')) {

            const userId = e.target.dataset.id;
            const newStatus = e.target.value;

            fetch(`/admin/users/status/${userId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(r => r.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat update status!'
                });
            });

        }
    });

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/admin/users/index.blade.php ENDPATH**/ ?>