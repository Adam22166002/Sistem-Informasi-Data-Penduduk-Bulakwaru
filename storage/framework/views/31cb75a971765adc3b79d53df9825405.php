<div class="modal fade" id="modalTambahKK" tabindex="-1">
    <div class="modal-dialog">
        <form id="formKK" enctype="multipart/form-data" class="modal-content">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Penduduk Berdasarkan No KK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="rumah_id_kk" name="rumah_id">

                <div class="mb-3">
                    <label>No. KK</label>
                    <input type="text" name="no_kk" class="form-control" required>
                    <small class="text-muted">
                        Masukkan No. KK untuk menautkan seluruh anggota keluarga ke rumah ini.
                    </small>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {

    const formKK = document.getElementById("formKK");

    formKK.addEventListener("submit", async function(e) {
        e.preventDefault();

        let formData = new FormData(formKK);

        const res = await fetch("<?php echo e(route('penduduk.assignByKK')); ?>", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });
            bootstrap.Modal.getInstance(document.getElementById("modalTambahKK")).hide();
            updateLocalByKK(data.penduduk, formData.get("rumah_id"));
        } 
        else {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: data.message ?? "Terjadi kesalahan!"
            });
        }
    });

});
</script>
<?php /**PATH D:\Project-Programmer\project-ta\resources\views/admin/penduduk/modal_kk.blade.php ENDPATH**/ ?>