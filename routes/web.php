<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DaftarPeminjamanBarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PeminjamanBarangDikonfirmasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\Peminjam\HistoryPeminjamanBarangController;
use App\Http\Controllers\Peminjam\PeminjamanBarangController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::post('/login', [LoginBasic::class, 'store']);
    Route::get('/register', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::post('/register', [RegisterBasic::class, 'store']);
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => 'role:Admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori-index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori-create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori-store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori-edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori-update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori-destroy');
        
        Route::get('/barang', [BarangController::class, 'index'])->name('barang-index');
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang-create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang-store');
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang-edit');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang-update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang-destroy');
        
        Route::get('/daftar-peminjaman-barang', [DaftarPeminjamanBarangController::class, 'index'])->name('daftar-peminjaman-barang-index');
        Route::put('/daftar-peminjaman-barang/{id}', [DaftarPeminjamanBarangController::class, 'update']);
        
        Route::get('/peminjaman-barang-dikonfirmasi', [PeminjamanBarangDikonfirmasiController::class, 'index'])->name('peminjaman-barang-dikonfirmasi-index');
        Route::put('/alasan-pembatalan-barang/{id}', [PeminjamanBarangDikonfirmasiController::class, 'update']);
        Route::put('/pengembalian-barang/{id}', [PeminjamanBarangDikonfirmasiController::class, 'pengembalianBarang']);
        
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan-index');
        Route::get('/laporan/cetak-pdf', [LaporanController::class, 'cetakPDF'])->name('cetak-pdf');

        Route::get('/laporan-peminjaman-barang-dibatalkan-&-ditolak', [LaporanController::class, 'laporanDibatalkan'])->name('laporan-dibatalkan-index');
    });
    
    Route::group(['middleware' => 'role:Peminjam'], function () {
        Route::get('/peminjaman-barang', [PeminjamanBarangController::class, 'index'])->name('peminjaman-barang');
        Route::get('/form-peminjaman-barang/{id}', [PeminjamanBarangController::class, 'form']);
        Route::post('/peminjaman-barang', [PeminjamanBarangController::class, 'store']);
        
        Route::get('/history-peminjaman-barang', [HistoryPeminjamanBarangController::class, 'index'])->name('history-peminjaman-barang');
    });
    
    Route::post('/logout', [LoginBasic::class, 'destroy']);
});
