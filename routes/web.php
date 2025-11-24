<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\User\PesananController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('kategori', KategoriController::class);

    Route::get('/orders', [OrderController::class, 'adminindex'])->name('orders.index');

    Route::patch('/orders/{order}/approve',  [OrderController::class, 'approve'])->name('orders.approve');
    Route::patch('/orders/{order}/reject',   [OrderController::class, 'reject'])->name('orders.reject');

    Route::patch('/orders/{order}/confirm',  [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::patch('/orders/{order}/pack',     [OrderController::class, 'pack'])->name('orders.pack');
    Route::patch('/orders/{order}/ship',     [OrderController::class, 'ship'])->name('orders.ship');
    Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::patch('/orders/{order}/cancel',   [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('/pesan-masuk', [ContactController::class, 'adminIndex'])->name('contact.index');
    Route::get('/pesan-masuk/{message}', [ContactController::class, 'adminShow'])->name('contact.show');
    Route::post('/pesan-masuk/{message}/balas', [ContactController::class, 'adminReply'])->name('contact.reply');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/produk', [ProductController::class, 'catalog'])->name('produk.index');
    Route::get('/produk/{product}', [ProductController::class, 'detail'])->name('produk.show');

    // Halaman daftar kategori untuk user
    Route::get('/kategoris', [KategoriController::class, 'frontend'])
        ->name('kategori.frontend');

    // Halaman detail kategori + produknya
    Route::get('/kategoris/{id}', [KategoriController::class, 'detail'])
        ->name('kategori.detail');

    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Orders
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{code}/terima-kasih', [OrderController::class, 'success'])->name('success');
        Route::get('/{code}/pembayaran', [OrderController::class, 'payment'])->name('payment');
        Route::post('/{code}/upload-bukti', [OrderController::class, 'uploadProof'])->name('upload-proof');
        // Route untuk user konfirmasi penerimaan pesanan
    Route::patch('/{code}/received', [OrderController::class, 'received'])->name('received');
    });

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

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
