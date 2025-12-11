

<?php $__env->startSection('title', 'Koordinat Rumah SIDADU'); ?>
<?php $__env->startSection('sub-title', 'Mengelola Koordinat Data Rumah Desa Bulakwaru'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css"/>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-md-12">
            <div id="map" style="height: 650px; border-radius: 10px;"></div>
        </div>
    </div>

    
    <div class="modal fade" id="rumahModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="rumahForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Rumah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-2">
                            <label class="form-label">Kode Rumah</label>
                            <input type="text" id="kode_rumah" name="kode_rumah" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label">RT</label>
                                <input type="number" id="rt" name="rt" class="form-control">
                            </div>
                            <div class="col">
                                <label class="form-label">RW</label>
                                <input type="number" id="rw" name="rw" class="form-control">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const map = L.map("map", { 
        preferCanvas: true,
        center: [-6.9326, 109.1938], 
        zoom: 16 
    });

    L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        subdomains: ["mt0","mt1","mt2","mt3"],
        maxZoom: 20
    }).addTo(map);

    // batas desa
    fetch('<?php echo e(asset("assets/geojson/batas-bulakwaru.geojson")); ?>')
    .then(r => r.json())
    .then(json => {
        const batas = L.geoJSON(json, { style: { color:"red", weight:2, fill: false } }).addTo(map);
        map.fitBounds(batas.getBounds());
    });


    let rumahLayer;
    let batasRTRWLayer;
    let rtRwFeatures = [];

    function loadRTRW() {
        fetch('<?php echo e(asset("assets/geojson/batas-rt-rw01.geojson")); ?>')
            .then(r => r.json())
            .then(json => {
                rtRwFeatures = json.features;

                batasRTRWLayer = L.geoJSON(json, {
                    style: { color: "#ff0000", weight: 1.5, fillOpacity: 0.1 },
                    onEachFeature: (feature, layer) => {
                        const { rt, rw } = feature.properties;
                        const label = `RT ${rt} / RW ${rw}`;
                        const center = layer.getBounds().getCenter();

                        L.tooltip({
                            permanent: true,
                            direction: 'center',
                            className: 'rt-label'
                        }).setContent(label).setLatLng(center).addTo(map);
                    }
                }).addTo(map);
            });
    }

    loadRTRW();

    const iconRumah = L.icon({
        iconUrl: "/assets/img/koordinat.png",
        iconSize: [28,28],
        iconAnchor: [14,28]
    });

    let clusterGroup = L.markerClusterGroup();
    map.addLayer(clusterGroup);

    function loadRumah() {
        clusterGroup.clearLayers();

        fetch('<?php echo e(route("api.rumah.geojson")); ?>')
        .then(r => r.json())
        .then(json => {
            json.features.forEach(f => {
                const [lng, lat] = f.geometry.coordinates;

                const marker = L.marker([lat, lng], { icon: iconRumah });

                marker.on("click", () => openActionPopup(marker, f.properties));

                clusterGroup.addLayer(marker);
            });
        });
    }

    loadRumah();

    function openActionPopup(marker, p) {
        marker.bindPopup(`
            <b>${p.kode_rumah}</b><br>${p.alamat}<br>RT ${p.rt}/RW ${p.rw}
            <hr>
            <button class="btn btn-warning btn-sm w-100" onclick="editRumah(${p.id})">Edit</button>
            <button class="btn btn-danger btn-sm w-100 mt-2" onclick="deleteRumah(${p.id})">Hapus</button>
        `).openPopup();
    }

    window.editRumah = async function(id) {
        const res = await fetch(`/admin/rumah/${id}/edit`);
        const r = await res.json();

        const form = document.getElementById('rumahForm');
        form.dataset.mode = "edit";
        form.dataset.id = id;

        document.getElementById('kode_rumah').value = r.kode_rumah;
        document.getElementById('alamat').value = r.alamat;
        document.getElementById('rt').value = r.rt;
        document.getElementById('rw').value = r.rw;
        document.getElementById('keterangan').value = r.keterangan;
        document.getElementById('latitude').value = r.latitude;
        document.getElementById('longitude').value = r.longitude;

        new bootstrap.Modal('#rumahModal').show();
    };

    window.deleteRumah = function(id) {
        Swal.fire({
            title: "Hapus rumah?",
            text: "Data tidak bisa dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus"
        }).then(async result => {
            if (result.isConfirmed) {
                await fetch(`/admin/rumah/${id}`, {
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>" }
                });
                Swal.fire("Berhasil!", "Data dihapus.", "success");
                loadRumah();
            }
        });
    };
    document.getElementById("rumahForm").addEventListener("submit", async e => {
    e.preventDefault();

    const form = e.target;
    const mode = form.dataset.mode;
    const id = form.dataset.id;

    const url = mode === "edit" ? `/admin/rumah/${id}` : `/admin/rumah`;
    const method = mode === "edit" ? "PUT" : "POST";

    const formData = new FormData(form);

    const res = await fetch(url, {
        method,
        headers: { 
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: formData
    });

    if (res.ok) {
        Swal.fire("Berhasil!", "Data tersimpan.", "success");
        bootstrap.Modal.getInstance(document.getElementById("rumahModal")).hide();
        loadRumah();
    } else {
        Swal.fire("Error!", "Gagal menyimpan data.", "error");
    }
});
    map.on("click", e => {
        const { lat, lng } = e.latlng;
        const form = document.getElementById("rumahForm");
        form.reset();
        form.dataset.mode = "create";

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;

        new bootstrap.Modal("#rumahModal").show();
    });

});
</script>
<style>
.rt-label {
    background: rgba(255,255,255,0.7);
    padding: 3px 6px;
    font-size: 11px;
    border-radius: 6px;
    border: 1px solid #007bff;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/admin/rumah/index.blade.php ENDPATH**/ ?>