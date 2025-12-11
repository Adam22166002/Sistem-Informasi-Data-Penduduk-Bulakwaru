# 🏡 SIDADU – Sistem Informasi Data Penduduk  
Aplikasi **Sistem Informasi Geografis (SIG)** untuk pemutakhiran data penduduk Desa Bulakwaru berbasis **Laravel 12** dan **Leaflet.js**.  
SIDADU memvisualisasikan **denah rumah** serta **data penduduk** dalam bentuk peta interaktif untuk meningkatkan efisiensi dan akurasi data desa.

---

## 🚀 Fitur Utama
- 📍 **Peta GIS Interaktif (Leaflet.js)**  
  Menampilkan lokasi rumah warga di peta desa.

- 👨‍👩‍👧 **Manajemen Data Penduduk**  
  CRUD data individu dan keluarga.

- 🏠 **Data Rumah & Koordinat**  
  Menyimpan titik koordinat rumah beserta informasi penghuni.

- 🔍 **Pencarian Data Real-Time**  
  Cari penduduk berdasarkan nama, NIK, atau alamat.

- 📊 **Dashboard Statistik Penduduk**  
  Menampilkan jumlah penduduk, keluarga, dan grafik visual.

- 🔐 **Autentikasi User (Laravel Breeze/Fortify)**  
  Mendukung role admin & operator desa.

---

## 🛠️ Teknologi yang Digunakan
- **Laravel 12**
- **PHP 8.2+**
- **MySQL**
- **Leaflet.js (OpenStreetMap)**
- **Vite**
- **NPM**
- **Bootstrap / Tailwind CSS (opsional)**

---

## 📁 Struktur Folder Penting
app/
resources/
 ├─ views/
 ├─ js/
 ├─ css/
routes/
 ├─ web.php
public/
 ├─ geosjon/
database/
 ├─ migrations/


---

## 📦 Instalasi

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/sidadu.git
cd sidadu
