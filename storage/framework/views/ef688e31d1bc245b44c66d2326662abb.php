

<?php $__env->startSection('title', 'Manajemen Data Penduduk'); ?>
<?php $__env->startSection('sub-title', 'Mengelola Data Penduduk Desa Bulakwaru'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css">
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<div class="container-fluid">

    <form action="<?php echo e(route('penduduk.import')); ?>" method="POST" enctype="multipart/form-data" class="mb-3">
        <?php echo csrf_field(); ?>
        <div class="input-group">
            <input type="file" name="file" class="form-control" required>
            <button class="btn btn-success">Import Data</button>
        </div>
    </form>

    <div id="map" style="height: 500px; border-radius: 8px;"></div>

</div>

<?php echo $__env->make('admin.penduduk.modal_penduduk', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('admin.penduduk.modal_kk', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const map = L.map("map", {
        center: [-6.9326, 109.1938],
        zoom: 16,
        preferCanvas: true
    });

    L.tileLayer("https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}", {
        subdomains: ["mt0","mt1","mt2","mt3"],
        maxZoom: 20
    }).addTo(map);

    fetch(`<?php echo e(asset('assets/geojson/batas-bulakwaru.geojson')); ?>`)
    .then(r => r.json())
    .then(json => {
        const batas = L.geoJSON(json, { style:{color:"red", weight:2,fill: false} });
        map.addLayer(batas);
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
        iconSize: [26, 26],
        iconAnchor: [13, 26]
    });

    let clusterGroup = L.markerClusterGroup();
    map.addLayer(clusterGroup);

    const rumahData = <?php echo json_encode($rumah, 15, 512) ?>;

    function loadMarkers() {
        clusterGroup.clearLayers();

        rumahData.forEach(r => {
            if (!r.latitude || !r.longitude) return;

            const marker = L.marker([r.latitude, r.longitude], { icon: iconRumah });

            marker.on("click", () => openPopup(marker, r));

            clusterGroup.addLayer(marker);
        });
    }

    loadMarkers();

    function openPopup(marker, r) {
        let kepala = r.penduduk?.length ? r.penduduk[0] : null;

        let popup = `
            <b>${r.kode_rumah}</b><br>
            ${r.alamat ?? ""}<br>
            RT ${r.rt}/RW ${r.rw}<br>
            Jumlah Penduduk: <b>${r.penduduk_count}</b><br>
            ${kepala ? 
                `<br><b>Kepala Keluarga:</b><br>${kepala.nama}<br>NIK: ${kepala.nik}` 
                : `<br><i>Belum ada Kepala Keluarga</i>`
            }
            <hr>
            <button class="btn btn-primary btn-sm w-100" onclick="tambahPenduduk(${r.id})">Tambah Penduduk</button>
            <button class="btn btn-warning btn-sm w-100 mt-2" onclick="tambahKk(${r.id})">Tambah via KK</button>
        `;

        marker.bindPopup(popup).openPopup();
    }

    window.tambahPenduduk = function(id) {
        document.getElementById("rumah_id").value = id;
        new bootstrap.Modal("#modalPenduduk").show();
    };

    window.tambahKk = function(id) {
        document.getElementById("rumah_id_kk").value = id;
        new bootstrap.Modal("#modalTambahKK").show();
    };

    function updateLocalDataPenduduk(penduduk) {
        let rumah = rumahData.find(r => r.id == penduduk.rumah_id);
        if (!rumah) return;
        rumah.penduduk.push(penduduk);
        rumah.penduduk_count++;
        clusterGroup.eachLayer(marker => {
            let pos = marker.getLatLng();
            if (pos.lat == rumah.latitude && pos.lng == rumah.longitude) {
                openPopup(marker, rumah);
            }
        });
    }

    function updateLocalByKK(pendudukList, rumahId) {
        let rumah = rumahData.find(r => r.id == rumahId);
        if (!rumah) return;
        pendudukList.forEach(p => {
            rumah.penduduk.push(p);
            rumah.penduduk_count++;
        });
        clusterGroup.eachLayer(marker => {
            let pos = marker.getLatLng();
            if (pos.lat == rumah.latitude && pos.lng == rumah.longitude) {
                openPopup(marker, rumah);
            }
        });
    }
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/admin/penduduk/index.blade.php ENDPATH**/ ?>