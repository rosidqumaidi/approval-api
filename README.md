Approval API

Approval API adalah sistem API berbasis Laravel yang dirancang untuk menangani proses persetujuan transaksi multi-tahap. Sistem ini memastikan bahwa setiap transaksi harus melalui proses persetujuan berurutan, dari tahap awal hingga akhir, sebelum disetujui.

Fitur Utama

Proses Persetujuan Berurutan: Setiap persetujuan harus dilakukan secara berurutan dari tahap awal hingga tahap akhir.
Manajemen Approver: Menambah, mengedit, dan menghapus approver.
Manajemen Tahap Persetujuan: Menambah, mengedit, dan menghapus tahap persetujuan.
Manajemen Transaksi: Menambah, mengedit, dan menghapus transaksi.
Manajemen Persetujuan: Mengelola status persetujuan transaksi.

Prerequisites

PHP 7.4 atau lebih tinggi
Laravel 8
Composer
Database (MySQL, PostgreSQL, dll.)

Instalasi

Extract File ZIP
Buka CMD, lalu masuk ke direktori foldernya
composer install
Konfigurasi Environment
Salin file .env.example ke .env dan sesuaikan konfigurasi sesuai kebutuhan Anda.
cp .env.example .env

Generate Key Aplikasi
php artisan key:generate

Migrasi Database
php artisan migrate

Jika Anda ingin mengisi database dengan data awal.
php artisan db:seed

Jalankan Server
php artisan serve
Server akan berjalan di http://localhost:8000.

Endpoints API

Transaksi

POST /expense - Menambah transaksi baru.
GET /expense/{id} - Mengambil detail transaksi.
PATCH /expense/{id}/approve - Menyetujui transaksi pada tahap saat ini.

Tahap Persetujuan

POST /approval-stages - Menambah tahap persetujuan baru.
PUT /approval-stages/{id} - Memperbarui tahap persetujuan.

Approver

POST /approvers - Menambah approver baru