<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
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

// Route Checkout
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// Redirect /login ke admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| RUTE SISI ADMIN (Backend)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Rute Login (bebas akses)
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Rute yang dilindungi Middleware
    Route::middleware(['auth', 'admin'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Event
        Route::resource('events', EventController::class);

        // CRUD Kategori
        Route::resource('categories', CategoryController::class)->names([
            'index'   => 'categories.index',
            'create'  => 'categories.create',
            'store'   => 'categories.store',
            'edit'    => 'categories.edit',
            'update'  => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

        // CRUD Partner
        Route::resource('partners', PartnerController::class)->names([
            'index'   => 'partners.index',
            'create'  => 'partners.create',
            'store'   => 'partners.store',
            'edit'    => 'partners.edit',
            'update'  => 'partners.update',
            'destroy' => 'partners.destroy',
        ]);

        // Transaksi Admin
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');

    });

});