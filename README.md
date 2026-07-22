# Sistem Informasi Perpustakaan

## Deskripsi Project

Sistem Informasi Perpustakaan merupakan aplikasi berbasis web yang dibuat untuk membantu proses pengelolaan perpustakaan secara digital. Sistem ini dirancang untuk mempermudah admin dalam mengelola data buku, kategori, penerbit, rak, serta mengelola proses peminjaman dan pengembalian buku.

Aplikasi ini dibuat sebagai project pengembangan sistem informasi dengan menerapkan konsep CRUD (Create, Read, Update, Delete), manajemen database, serta implementasi framework Laravel.


## Tujuan Pembuatan

Tujuan dari pembuatan Sistem Informasi Perpustakaan ini yaitu:

- Membantu pengelolaan data perpustakaan agar lebih terstruktur.
- Mempermudah admin dalam mengelola koleksi buku.
- Mempermudah proses peminjaman dan pengembalian buku.
- Mengurangi kesalahan pencatatan data secara manual.


## Teknologi yang Digunakan

**Backend**
- Laravel
- PHP

**Frontend**
- HTML
- CSS
- Bootstrap
- JavaScript

**Database**
- MySQL

**Tools**
- Visual Studio Code
- XAMPP/Laragon
- Git & GitHub


## Hak Akses Pengguna

### Admin
Admin memiliki akses untuk:
- Mengelola data buku
- Mengelola kategori buku
- Mengelola data penerbit
- Mengelola data rak
- Mengelola data anggota
- Mengelola data user
- Mengelola transaksi peminjaman dan pengembalian

### Petugas
Admin memiliki akses untuk:
- Mengelola data buku
- Mengelola kategori buku
- Mengelola data penerbit
- Mengelola data rak
- Mengelola data anggota
- Mengelola transaksi peminjaman dan pengembalian
  
### Peminjam
Peminjam dapat:
- Melihat daftar buku
- Melakukan peminjaman buku
- Melihat riwayat peminjaman


## Fitur Utama

### Manajemen Buku
- Menampilkan daftar buku
- Menambah data buku
- Mengubah data buku
- Menghapus data buku

### Manajemen Kategori
- Mengelola kategori buku

### Manajemen Penerbit
- Mengelola informasi penerbit buku

### Manajemen Rak
- Mengatur lokasi penyimpanan buku berdasarkan rak

### Transaksi Peminjaman
- Proses peminjaman buku
- Proses pengembalian buku
- Perhitungan status peminjaman

### Manajemen Pengguna
- Pengelolaan akun pengguna berdasarkan role


## Database

Database yang digunakan memiliki beberapa tabel utama:

- users
- anggota
- buku
- kategori
- penerbit
- rak
- peminjaman
- detail_peminjaman

Relasi antar tabel dibuat untuk mengatur hubungan data buku, pengguna, dan transaksi peminjaman.


## Instalasi dan Menjalankan Project

### 1. Clone Repository

- git clone https://github.com/HanaZahra-dev/Sistem-Informasi-Perpustakaan.git
- cd Sistem-Informasi-Perpustakaan
- composer install
- cp .env.example .env
- DB_DATABASE=db_perpus_baru
- DB_USERNAME=root
- DB_PASSWORD=
- php artisan migrate
- php artisan serve
- http://127.0.0.1:8000

## Lisensi
Project ini dibuat untuk keperluan pembelajaran, project mata kuliah, dan pengembangan portofolio pribadi.  
Seluruh kode dalam repository ini dapat digunakan sebagai referensi pembelajaran

### Author
Hana Rahmaya Zahra

