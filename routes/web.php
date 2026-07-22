<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TransactionController;

/*
|--------------------------------------------------------------------------
| RUTE SISI USER (Frontend)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kontak', function () { return view('contact'); });
Route::get('/profil', function () { return view('profil'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });

Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');

// Route Checkout & Pembayaran
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/cancel/{id}', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
// Fitur Baru: Download Sertifikat
Route::get('/checkout/{order_id}/certificate', [CheckoutController::class, 'downloadCertificate'])->name('checkout.certificate');

// Route Webhook Midtrans
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// ==========================================
// FITUR UAS: SSO GOOGLE LOGIN
// ==========================================
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// ==========================================

// ==========================================
// FITUR UAS: RATING & REVIEW
// ==========================================
Route::post('/events/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
// ==========================================

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| RUTE SISI ADMIN (Backend)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    });
});

/*
|--------------------------------------------------------------------------
| RUTE TES EMAIL (Jalur Pintas)
|--------------------------------------------------------------------------
*/
Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('Halo! Ini adalah tes kurir email dari Laravel.', function ($message) {
        $message->to('tes@amikomeventhub.com')
                ->subject('Email Percobaan Sukses!');
    });
    return 'HORE! Kurir email sudah jalan. Silakan cek file storage/logs/laravel.log sekarang!';
});