## Approval API

Approval API adalah sistem API berbasis Laravel yang dirancang untuk menangani proses persetujuan transaksi multi-tahap. Sistem ini memastikan bahwa setiap transaksi harus melalui proses persetujuan berurutan, dari tahap awal hingga akhir, sebelum disetujui.
	
## Fitur Utama

* Proses Persetujuan Berurutan: Setiap persetujuan harus dilakukan secara berurutan dari tahap awal hingga tahap akhir.
* Manajemen Approver: Menambah, mengedit, dan menghapus approver.
* Manajemen Tahap Persetujuan: Menambah, mengedit, dan menghapus tahap persetujuan.
* Manajemen Transaksi: Menambah, mengedit, dan menghapus transaksi.
* Manajemen Persetujuan: Mengelola status persetujuan transaksi.

## Persyaratan

* PHP 7.4 atau lebih tinggi
* Laravel 8
* Composer
* MySQL Database
	
## Instalasi
Berikut cara setup project di lokal:

* Clone project dari repository
```
$ git clone https://github.com/rosidqumaidi/approval-api.git
```

* Masuk ke direktori projectnya di dalam command prompt (CMD)
```
$ cd approval-api
```

* Install composer
```
$ composer install
```

* Konfigurasi Environment (.env)
Salin file .env.example ke .env dan sesuaikan konfigurasi sesuai kebutuhan Anda
```
$ cp .env.example .env
```
Pastikan konfigurasi database sudah sesuai

* Generate key
```
$ php artisan key:generate
```

* Migrasi database
```
$ php artisan migrate
```

* Jika Anda ingin mengisi database dengan data awal.
```
$ php artisan db:seed
```

* Jalankan Server
```
$ php artisan serve
Server akan berjalan di http://localhost:8000.
```
