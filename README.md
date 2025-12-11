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

## 📦 Instalasi

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/sidadu.git
cd sidadu
```
### 2️⃣ Install Dependencies Laravel
```bash
composer install
```
### 3️⃣ Copy Environment File
```bash
cp .env.example .env
php artisan key:generate
```
### 5️⃣ Migrasi & Seeder
```bash
php artisan migrate --seed
```

## 🧩 Instalasi Frontend (Vite + NPM)

### 6️⃣ Install NPM Packages
```bash
npm install
```
### 7️⃣ Jalankan Dev Server
```bash
npm run dev
```
### 8️⃣ Jalankan Laravel
```bash
php artisan serve
```
