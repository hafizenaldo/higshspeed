<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

// ✅ Halaman utama diarahkan ke halaman dashboard
// Route::get('/', function () {
//     return redirect()->route('dashboard');
Route::get('/', function () {
        return view('home');
    })->name('home');

// });
    // ✅ Halaman about
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
    // ✅ Halaman home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    // Contact
    Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::post('/contact/submit', [HomeController::class, 'submitContact'])->name('contact.submit');

    Route::get('/cara-sewa', [App\Http\Controllers\HomeController::class, 'carasewa'])->name('carasewa');



// ✅ Group route untuk bagian admin
Route::prefix('admin')->group(function () {

    // ✅ Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ CRUD Produk (hanya index, bisa ditambah lainnya kalau perlu)
    Route::resource('produk', ProdukController::class);

    // ✅ CRUD Kategori (lengkap)
    Route::resource('kategori', KategoriController::class);







});
