<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AdminRegisterController;

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

// Guest routes (not logged in)
Route::middleware('guest')->group(function () {
    // Admin registration
    Route::get('/admin/register', [AdminRegisterController::class, 'create'])
        ->name('admin.register');
    
    Route::post('/admin/register', [AdminRegisterController::class, 'store'])
        ->name('admin.register.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::resource('products', ProductController::class);

    Route::get('/pesan-masuk', [ContactController::class, 'adminIndex'])->name('contact.index');
    Route::get('/pesan-masuk/{message}', [ContactController::class, 'adminShow'])->name('contact.show');
    Route::post('/pesan-masuk/{message}/balas', [ContactController::class, 'adminReply'])->name('contact.reply');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Admin Profile Routes
    Route::get('/profil', [ProfileController::class, 'adminEdit'])->name('profil.edit');
    Route::patch('/profil', [ProfileController::class, 'adminUpdate'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'adminUpdatePassword'])->name('profil.password.update');
    Route::delete('/profil', [ProfileController::class, 'adminDestroy'])->name('profil.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/produk', [ProductController::class, 'catalog'])->name('produk.index');
    Route::get('/produk/{product}', [ProductController::class, 'detail'])->name('produk.show');

    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist', [WishlistController::class, 'clear'])->name('wishlist.clear');

    // USER
    Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
    Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
