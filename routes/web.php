<?php

use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BrosurController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\MajalahController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\UndanganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/produk/{id}', [HomeController::class, 'detail_product'])->name('detail_product');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

Auth::routes(['verify' => true]);

Route::get('/provinsi', [OngkirController::class, 'province'])->name('provinsi');
Route::get('/kota-{province_id}', [OngkirController::class, 'city'])->name('kota');
Route::post('/ongkir', [OngkirController::class, 'cost'])->name('ongkir');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/keranjang', [HomeController::class, 'cart'])->name('cart');

    Route::delete('/cart/clear/{transaksi}', [HomeController::class, 'clear'])->name('cart.clear');

    Route::get('/pembelian', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/kota/{province_id}', [ProfileController::class, 'city'])->name('profile.kota');

    Route::get('/pembayaran-{nomor_pesanan}', [HomeController::class, 'payment'])->name('payment');
    Route::get('/keranjang_saya', [HomeController::class, 'cart2'])->name('cart2');

    // ADMIN
    Route::middleware([Admin::class])
        ->prefix('admin')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::name('admin.')->group(function () {
                // KELOLA PRODUK
                Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
                Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
                Route::post('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
                Route::get('/produk/ukuran/{judul}', [ProductController::class, 'ukuran'])->name('product.ukuran');
                Route::post('/produk/ukuran/{product}/add', [ProductController::class, 'storeUkuran'])->name('product.ukuran.store');
                Route::post('/produk/ukuran/{ukuran}/update', [ProductController::class, 'updateUkuran'])->name('product.ukuran.update');
                Route::delete('/produk/ukuran/{ukuran}/delete', [ProductController::class, 'deleteUkuran'])->name('product.ukuran.delete');
                Route::post('/detail-ukuran/update-or-create', [ProductController::class, 'updateOrCreate'])->name('detailUkuran.updateOrCreate');

                Route::get('/detail-ukuran/{id}/value-ukuran', [ProductController::class, 'showValueUkuran'])->name('valueUkuran.value_ukuran');

                Route::post('/value-ukuran/update-or-create/{id}', [ProductController::class, 'updateOrCreateDetailValue'])->name('valueUkuran.updateOrCreate');

                // KELOLA USER
                Route::get('/user', [UserController::class, 'index'])->name('user.index');
                Route::post('/user', [UserController::class, 'store'])->name('user.store');
                Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
                Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

                //KELOLA PESANAN
                Route::get('/pesanan', [CartController::class, 'index'])->name('cart.index');
                Route::get('/pesanan/filter/{tanggalAwal}/{tanggalAkhir}', [CartController::class, 'filter'])->name('cart.filter');
                Route::put('/pesanan/{id}', [CartController::class, 'update'])->name('cart.update');
                Route::delete('/pesanan/{id}/destroy', [CartController::class, 'destroy'])->name('cart.destroy');

                //KELOLA PEMBAYARAN
                Route::get('/pembayaran', [PaymentController::class, 'index'])->name('payment.index');
                Route::put('/pembayaran/{id}', [PaymentController::class, 'update'])->name('payment.update');

                //KELOLA TENTANG
                Route::get('about/{id}/edit', [AboutPageController::class, 'edit'])->name('about.edit');
                Route::put('about/{id}/update', [AboutPageController::class, 'update'])->name('about.update');
            });
        });

    // USER
    Route::middleware([User::class])
        ->name('user.')
        ->prefix('user')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::post('/brosur', [BrosurController::class, 'store'])->name('brosur.store');
            Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
            Route::post('/kalender', [KalenderController::class, 'store'])->name('kalender.store');
            Route::post('/majalah', [MajalahController::class, 'store'])->name('majalah.store');
            Route::post('/undangan', [UndanganController::class, 'store'])->name('undangan.store');

            Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');
            Route::post('/feedback', [FeedbackController::class, 'feedbackStore'])->name('feedbackStore');
        });
});
