

<?php $__env->startSection('title','Peta SIDADU'); ?>
<?php $__env->startSection('sub-title','Sistem Informasi Geografis Penduduk Desa Bulakwaru'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<div class="container-fluid p-0 position-relative mb-4">

    <div class="card shadow-sm p-3 mb-3" style="z-index:1000; position:relative;">
        <form id="filterForm" class="row g-2">
            <div class="col-md-2">
                <label class="form-label mb-0">RT</label>
                <input id="rt" class="form-control form-control-sm">
            </div>

            <div class="col-md-2">
                <label class="form-label mb-0">RW</label>
                <input id="rw" class="form-control form-control-sm">
            </div>

            <?php if(auth()->guard()->check()): ?>
            <div class="col-md-4">
                <label class="form-label mb-0">Cari Penduduk</label>
                <input id="search" class="form-control form-control-sm" placeholder="Nama / NIK / No KK">
            </div>
            <?php endif; ?>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Cari</button>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" id="resetBtn" class="btn btn-outline-danger w-100">Reset</button>
            </div>
        </form>
    </div>

    <div id="map" style="height:85vh; width:100%; border-radius:10px;"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const map = L.map('map', {
        center: [-6.9326, 109.1938],
        zoom: 16,
        zoomControl: true,
        attributionControl: false
    });

    const googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0','mt1','mt2','mt3']
    });

    googleHybrid.addTo(map);

    const houseIcon = L.icon({
        iconUrl: '/assets/img/koordinat.png',
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -28]
    });
    // batas desa
    fetch('<?php echo e(asset("assets/geojson/batas-bulakwaru.geojson")); ?>')
        .then(res => res.json())
        .then(data => {
            const batasDesa = L.geoJSON(data, {
                style: { color: "#ff0000", weight: 2, fill: false }
            }).addTo(map);
            map.fitBounds(batasDesa.getBounds());
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

    let rumahCluster = L.markerClusterGroup();
    let cache = {};

    function popupHTML(d) {
        let rows = d.penduduk.length 
            ? d.penduduk.map(p => `<tr><td>${p.nama}</td><td>${p.nik}</td><td>${p.jenis_kelamin}</td><td>${p.status_keluarga}</td></tr>`).join('')
            : `<tr><td colspan=4 class="text-center">Tidak ada data</td></tr>`;

        return `
        <b>${d.kode_rumah}</b><br>${d.alamat}<br>RT ${d.rt} / RW ${d.rw}
        <hr>
        <table border=1 width=100% style="font-size:9px;">
            <thead><tr><th>Nama</th><th>NIK</th><th>JK</th><th>Status</th></tr></thead>
            <tbody>${rows}</tbody>
        </table>`;
    }

    async function loadDetail(marker, id) {
        const res = await fetch(`/api/rumah/detail/${id}`);
        const data = await res.json();
        marker.bindPopup(popupHTML(data)).openPopup();
    }

    function loadRumah(params={}) {

        rumahCluster.clearLayers();

        const key = JSON.stringify(params);
        if (!cache[key]) {
            cache[key] = fetch(`/api/geojson/filter?${new URLSearchParams(params)}`)
                .then(r => r.json());
        }

        cache[key].then(json => {
            json.features.forEach(f => {
                const [lng, lat] = f.geometry.coordinates;
                const marker = L.marker([lat,lng], { icon: houseIcon });

                marker.on("click", () => {
                    marker.bindPopup("<b>Loading...</b>").openPopup();
                    loadDetail(marker, f.properties.id);
                });

                rumahCluster.addLayer(marker);
            });

            map.addLayer(rumahCluster);

            if (json.features.length === 1) {
                const [lng, lat] = json.features[0].geometry.coordinates;
                map.setView([lat, lng], 19);
            }
        });
    }

    loadRumah();

    document.getElementById("filterForm").addEventListener("submit", e => {
        e.preventDefault();
        loadRumah({
            rt: rt.value,
            rw: rw.value,
            search: search?.value || ""
        });
    });

    document.getElementById("resetBtn").addEventListener("click", () => {
        rt.value = "";
        rw.value = "";
        search.value = "";
        loadRumah();
        map.setView([-6.9326,109.1938], 16);
    });

    let userMarker;

    const start = () =>
    navigator.geolocation.watchPosition(
        ({ coords }) => {
            const { latitude: lat, longitude: lng } = coords;

            if (!userMarker) {
                userMarker = L.circleMarker([lat, lng], {
                    radius: 6,
                    color: "#1368CE",
                    fillColor: "#1368CE",
                    fillOpacity: 1
                }).addTo(map);
            } else {
                userMarker.setLatLng([lat, lng]);
            }
        },
        () => alert("Lokasi tidak dapat diakses."),
        { enableHighAccuracy: true }
    );

    localStorage.getItem("loc_once")
    ? start()
    : Swal.fire({
        title: "Aktifkan Lokasi?",
        text: "Aktifkan agar titik posisi Anda muncul di peta.",
        icon: "info",
        showCancelButton: true
    }).then(r => {
        if (r.isConfirmed) start();
        localStorage.setItem("loc_once", 1);
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project-Programmer\project-ta\resources\views/peta.blade.php ENDPATH**/ ?>