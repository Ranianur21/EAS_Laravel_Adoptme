<?php

use App\Models\Hewan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\AdopsiController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE PUBLIK (Tidak memerlukan login) ---
Route::get('/', [HomeController::class, 'index'])->name('home'); 

Route::get('/kontak', function () {
    return view('user.kontak');
})->name('kontak');

Route::get('/tentang', function () {
    return view('user.tentang');
})->name('tentang');

Route::get('/hewan', [HewanController::class, 'index'])->name('hewan');
Route::get('/hewan/{id}', [HewanController::class, 'show'])->name('hewan.show');

Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');

//route daftarkan hewan
Route::get('/daftarkanhewan', [HewanController::class, 'daftarkanHewanForm'])->name('daftarkanhewan.form');
Route::post('/daftarkanhewan', [HewanController::class, 'store'])->name('daftarkanhewan.store');


// --- RUTE YANG MEMBUTUHKAN LOGIN ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
    $hewansTersedia = Hewan::where('status', 'tersedia')->get();
    $hewansDiadopsi = Hewan::where('status', 'diadopsi')->latest()->take(4)->get();
    return view('dashboard', compact('hewansTersedia', 'hewansDiadopsi'));
})->name('dashboard');

    // Halaman profil kustom (menampilkan info & riwayat adopsi user)
    Route::get('/profil', [UserProfileController::class, 'showProfile'])->name('profil');


    Route::get('/panduan', function () {
        return view('panduan');
    })->name('panduan');

    // --- RUTE ADOPSI ---
Route::get('/adopsi/form/{hewan_id}', [AdopsiController::class, 'showAdopsiForm'])->name('adopsi.form');

// Route untuk submit form
Route::post('/adopsi/submit', [AdopsiController::class, 'submitAdopsiForm'])->name('adopsi.submit');

// Route untuk konfirmasi
Route::get('/adopsi/konfirmasi', function () {
    return view('adopsi.konfirmasi');
})->name('adopsi.konfirmasi');

});

// Rute otentikasi Laravel Breeze (login, register, dsb.)
require __DIR__.'/auth.php';