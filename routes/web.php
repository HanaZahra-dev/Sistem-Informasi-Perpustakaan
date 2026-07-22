<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CekRoleController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Peminjam\DaftarAnggotaController;
use App\Http\Controllers\Peminjam\IdentifikasiController;
use App\Http\Controllers\Peminjam\PilihBukuController;
use App\Http\Controllers\Peminjam\BukuController as PeminjamBukuController;
use App\Http\Controllers\Peminjam\DashboardPeminjamController;
use App\Http\Controllers\Peminjam\KeranjangController;
use App\Http\Controllers\Petugas\BukuController;
use App\Http\Controllers\Petugas\ChartController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\Petugas\PenerbitController;
use App\Http\Controllers\Petugas\RakController;
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Petugas\AnggotaController;
use App\Http\Controllers\Peminjam\KonfirmasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman Beranda (Landing Page)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Koleksi Buku (publik)
Route::get('/koleksi-buku', PeminjamBukuController::class)->name('koleksi.buku');

// Alur Pinjam Buku (tanpa login)
Route::get('/pinjam', [IdentifikasiController::class, 'index'])->name('pinjam.identifikasi');
Route::post('/pinjam/identifikasi', [IdentifikasiController::class, 'store'])->name('pinjam.identifikasi.store');
Route::get('/pinjam/pilih-buku', [PilihBukuController::class, 'index'])->name('pinjam.pilih-buku');
Route::post('/pinjam/pilih-buku/tambah', [PilihBukuController::class, 'tambah'])->name('pinjam.pilih-buku.tambah');
Route::post('/pinjam/pilih-buku/hapus', [PilihBukuController::class, 'hapus'])->name('pinjam.pilih-buku.hapus');

Route::get('/pinjam/konfirmasi', function () {
    if (!session('peminjam_identifikasi')) {
        return redirect()->route('pinjam.identifikasi');
    }
    if (empty(session('keranjang_pinjam'))) {
        return redirect()->route('pinjam.pilih-buku')
            ->with('info', 'Pilih minimal 1 buku terlebih dahulu.');
    }
    return app(KonfirmasiController::class)->index();
})->name('pinjam.konfirmasi');

Route::post('/pinjam/ajukan', [KonfirmasiController::class, 'ajukan'])->name('pinjam.ajukan');

Route::get('/pinjam/selesai', function () {
    if (!session('peminjaman_selesai')) {
        return redirect()->route('pinjam.identifikasi');
    }
    return view('peminjam.selesai.index', ['data' => session('peminjaman_selesai')]);
})->name('pinjam.selesai');

Route::get('/pinjam/daftar-anggota', [DaftarAnggotaController::class, 'index'])->name('pinjam.daftar-anggota');
Route::post('/pinjam/daftar-anggota', [DaftarAnggotaController::class, 'store'])->name('pinjam.daftar-anggota.store');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/cek-role', CekRoleController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   // role admin dan petugas
Route::middleware(['role:admin|petugas'])->group(function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/kategori', KategoriController::class);
    Route::get('/rak', RakController::class);
    Route::get('/penerbit', PenerbitController::class);
    Route::get('/buku', BukuController::class);
    Route::get('/transaksi', TransaksiController::class);
    Route::get('/chart', ChartController::class);
    Route::get('/anggota', AnggotaController::class); 
    Route::get('/user', UserController::class);

    // PROFILE ADMIN/PETUGAS
    Route::get('/detail-profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


// role peminjam
Route::middleware(['role:peminjam'])->group(function () {
    Route::get('/dashboard-peminjam', [DashboardPeminjamController::class, 'index'])->name('dashboard.peminjam');
    Route::get('/keranjang', KeranjangController::class);
});
    // PROFILE PEMINJAM
    Route::get('/detail-profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});