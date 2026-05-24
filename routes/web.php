<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

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
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');


/*
|--------------------------------------------------------------------------
| RUTE SISI ADMIN (Backend dengan CRUD)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Event
    Route::resource('events', EventController::class);

    // CRUD Kategori (resource otomatis: index, create, store, edit, update, destroy)
    Route::resource('categories', CategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // CRUD Partner
    Route::resource('partners', PartnerController::class)->names([
        'index'   => 'admin.partners.index',
        'create'  => 'admin.partners.create',
        'store'   => 'admin.partners.store',
        'edit'    => 'admin.partners.edit',
        'update'  => 'admin.partners.update',
        'destroy' => 'admin.partners.destroy',
    ]);

    // Manajemen Transaksi
    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('admin.transactions.index');

});