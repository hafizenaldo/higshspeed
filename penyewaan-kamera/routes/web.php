<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

// ✅ Halaman utama diarahkan ke halaman dashboard
// Route::get('/', function () {
//     return redirect()->route('dashboard');
Route::get('/', function () {
        return view('home');
    })->name('home');

// });

// ✅ Group route untuk bagian admin
Route::prefix('admin')->group(function () {

    // ✅ Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ CRUD Produk (hanya index, bisa ditambah lainnya kalau perlu)
    Route::resource('produk', ProdukController::class);

    // ✅ CRUD Kategori (lengkap)
    Route::resource('kategori', KategoriController::class);
});
