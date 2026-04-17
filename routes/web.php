<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;

// =============================================
// RUTE SISI USER
// =============================================

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Event
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

// Halaman Checkout
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// Halaman Tiket
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// =============================================
// RUTE SISI ADMIN (prefix: /admin)
// =============================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Event Admin
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');

    // Manajemen Transaksi Admin
    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('transactions.index');

    // Manajemen Kategori Admin (Tugas Pertemuan 3)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

});

 // =================== ini bagian awal tugas 1 =====

 Route::get('/', function () {
    return view('welcome');
});

Route::get('/kontak', function () {
    return view('contact');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
}); 