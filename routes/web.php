<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HewanController; 
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Auth\RegisterController; 
use App\Http\Controllers\HomeController;

// Rute Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kontak', function () {
    return view('user.kontak'); 
})->name('kontak');

Route::get('/tentang', function () {
    return view('user.tentang'); 
})->name('tentang');

Route::get('/keranjang', function () {
    return view('keranjang'); 
})->name('keranjang');


Route::get('/hewan', [HewanController::class, 'index'])->name('hewan');
Route::get('/daftarAdopt', function () {
    return view('daftarAdopt'); 
})->name('daftarAdopt');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');

    Route::get('/toko', function () {
        return view('toko');
    })->name('toko');

    Route::get('/panduan', function () {
        return view('panduan'); 
    })->name('panduan');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});