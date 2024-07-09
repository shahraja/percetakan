<?php

use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BrosurController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ClientPaymentController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\MajalahController;
use App\Http\Controllers\UndanganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/produk/{id}', [HomeController::class, 'detail_product'])->name('detail_product');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
// Route::get('/pembayaran', [HomeController::class, 'paymnet'])->name('paymnet');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [HomeController::class, 'cart'])->name('cart');
    Route::get('/pembelian', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pembayaran/{produk_id}-{nomor_pesanan}-{metode_pengambilan}', [ClientPaymentController::class, 'create'])->name('payment');
    Route::put('/pembayaran/{produk_id}-{nomor_pesanan}-{metode_pengambilan}', [ClientPaymentController::class, 'update'])->name('payment.update');
    Route::get('/keranjang_saya', [HomeController::class, 'cart2'])->name('cart2');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ADMIN
Route::middleware([Admin::class])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // KELOLA PRODUK
    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::post('/produk/{id}', [ProductController::class, 'update'])->name('product.update');

    // KELOLA USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    //KELOLA PESANAN
    Route::get('/pesanan', [CartController::class, 'index'])->name('cart.index');
    Route::put('/pesanan/{id}', [CartController::class, 'update'])->name('cart.update');
    // Route::put('/pesanan/{id}', [TransaksiController::class, 'update'])->name('cart.update');
    
    //KELOLA PEMBAYARAN
    Route::get('/pembayaran', [PaymentController::class, 'index'])->name('payment.index');
    Route::put('/pembayaran/{id}', [PaymentController::class, 'update'])->name('payment.update');
});

// USER
Route::middleware([User::class])->name('user.')->prefix('user')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/brosur', [BrosurController::class, 'store'])->name('brosur.store');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::post('/kalender', [KalenderController::class, 'store'])->name('kalender.store');
Route::post('/majalah', [MajalahController::class, 'store'])->name('majalah.store');
Route::post('/undangan', [UndanganController::class, 'store'])->name('undangan.store');

});

});
