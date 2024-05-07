<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/produk/{id}', [HomeController::class, 'detail_product'])->name('detail_product');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::get('/keranjang', [HomeController::class, 'cart'])->name('cart');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

Auth::routes();

Route::middleware(['auth'])->group(function () {

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ADMIN
Route::middleware([Admin::class])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // KELOLA PRODUK
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::post('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
});

// USER
Route::middleware([User::class])->name('user.')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

});
