# 🏢 SIPFASKA - Sistem Informasi Pengaduan Fasilitas Kampus

Selamat datang di **SIPFASKA**! Solusi digital untuk mempermudah pelaporan, pemantauan, dan perbaikan fasilitas di lingkungan **Universitas Pamulang**. Proyek ini bertujuan menggantikan sistem pelaporan manual menjadi sistem terintegrasi yang transparan dan _real-time_.

[![Versi Proyek](https://img.shields.io/badge/version-1.0.0-blue?style=for-the-badge)](https://github.com/adammiftah/sipfaska)
[![Framework Digunakan](https://img.shields.io/badge/Framework-Laravel_10-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.3-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

---

## ✨ Mengapa SIPFASKA?

Kerusakan fasilitas kampus seringkali terlambat ditangani karena alur pelaporan yang rumit. Aplikasi kami hadir menawarkan:
* 🚀 **Pelaporan Cepat:** Mahasiswa bisa melapor kerusakan disertai bukti foto langsung dari HP.
* 📊 **Transparansi Status:** Pelapor bisa memantau apakah laporan masih "Diajukan", "Diproses", atau sudah "Selesai".
* 📑 **Administrasi Rapi:** Admin dapat mencetak rekapitulasi laporan dalam format PDF resmi dengan mudah.
* 📈 **Analisis Data:** Dashboard interaktif untuk melihat tren kerusakan fasilitas per bulan.
* 🔒 **Akses Terkontrol:** Hak akses berbeda untuk Admin, Petugas, dan Mahasiswa.

---

## 🎯 Fitur Unggulan

* 👤 **Multi-Role User** (Administrator, Petugas Lapangan, Mahasiswa)
* 📷 **Pelaporan dengan Bukti Foto** (Upload gambar kerusakan via Storage Link)
* 📊 **Dashboard Statistik Visual** (Menggunakan Chart.js untuk data bulanan)
* 🔄 **Tracking Status Real-time** (Pending ➝ Proses ➝ Selesai)
* 📄 **Cetak Laporan PDF Otomatis** (Menggunakan DomPDF dengan Kop Surat Resmi & Dukungan Base64 Image)
* 📂 **Manajemen Data Master** (Data Mahasiswa, Petugas, Kategori Kerusakan)
* 📱 **Desain Responsif** (Tampilan optimal di Desktop & Mobile)
* 🔐 **Keamanan Data** (Password Hashing & CSRF Protection)

---

## 🛠️ Stack Teknologi

Aplikasi ini dibangun dengan cinta dan teknologi modern:

* **Backend:** PHP (Framework Laravel 10/11)
* **Frontend:** Blade Templating, Bootstrap 5, FontAwesome
* **Database:** MySQL
* **Libraries:**
    * `barryvdh/laravel-dompdf` (Generate PDF)
    * `Chart.js` (Grafik Statistik)
* **Tools Lain:** Composer, Git, VS Code

---

## 🚀 Memulai (Getting Started)

Ingin mencoba menjalankan proyek ini di komputer lokal? Ikuti langkah-langkah berikut:

### 1. Prasyarat
* Pastikan Anda memiliki PHP >= 8.3
* Composer terinstal
* Web Server (XAMPP / Laragon)
* Database MySQL

### 2. Instalasi
```bash
# 1. Clone repository
git clone [https://github.com/adammiftah/sipfaska.git](https://github.com/adammiftah/sipfaska.git)
cd sipfaska

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi Database (.env)
#    Buka file .env dan sesuaikan:
#    DB_DATABASE=sipfaska
#    DB_USERNAME=root
#    DB_PASSWORD=

# 6. Buat Symlink Storage (PENTING untuk Foto)
php artisan storage:link

# 7. Jalankan migrasi & seeder
php artisan migrate --seed

# 8. Jalankan server
php artisan serve
```

---
### 3. Akun Demo (Default Seeder)
* Admin: admin@gmail.com / admin123
* Petugas: petugas@gmail.com / petugas123
* Mahasiswa: 221011400961 / 123456

---

### 🗺️ Roadmap Proyek
* **Sistem Login Multi-user**
* **CRUD Pengaduan & Upload Foto**
* **Cetak PDF Laporan Bulanan**
* **Integrasi Notifikasi WhatsApp Gateway**
* **Fitur Scan QR Code pada Fasilitas**
* **Rating Kepuasan Pelayanan**

---


## 🤝 Ingin Berkontribusi?
Kontribusi Anda sangat kami harapkan! Baik itu berupa ide, laporan bug, atau pull request.
- **Fork repository ini.**
- **Buat Branch baru (git checkout -b fitur/NamaFiturAnda).**
- **Commit perubahan Anda (git commit -m 'Menambahkan fitur keren').**
- **Push ke branch Anda (git push origin fitur/NamaFiturAnda).**
- **Buat Pull Request baru.**
- **Pastikan untuk mengikuti panduan kontribusi (jika ada file CONTRIBUTING.md).**

---

## 💌 Kontak & Dukungan

Punya pertanyaan, saran, atau ingin berdiskusi?

Email: [adammiftah196@gmail.com] 
