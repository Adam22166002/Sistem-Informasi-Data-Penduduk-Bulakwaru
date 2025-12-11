<div class="modal fade" id="modalPenduduk" tabindex="-1">
    <div class="modal-dialog">
        <form id="formPenduduk" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="rumah_id" name="rumah_id">

                <div class="mb-3">
                    <label>No KK</label>
                    <input type="text" name="no_kk" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nama Penduduk</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Status Keluarga</label>
                    <select name="status_keluarga" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {

    const formPenduduk = document.getElementById("formPenduduk");

    formPenduduk.addEventListener("submit", async function(e) {
        e.preventDefault();

        let formData = new FormData(formPenduduk);

        const res = await fetch("{{ route('penduduk.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        const data = await res.json();

        if (res.ok) {
            Swal.fire("Berhasil!", "Penduduk berhasil ditambahkan!", "success");

            bootstrap.Modal.getInstance(document.getElementById("modalPenduduk")).hide();
            updateLocalDataPenduduk(data.penduduk);
        } else {
            Swal.fire("Error!", "Gagal menyimpan data.", "error");
        }
    });
});
</script>
