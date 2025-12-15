<?php

use App\Models\Hewan;
use App\Models\Artikel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\AdopsiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminHewanController;
use App\Http\Controllers\AdminAdopsiController;
use App\Http\Controllers\UserProfileController;
use App\Models\Adopsi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE PUBLIK (Tidak memerlukan login) ---
Route::get('/', [HomeController::class, 'index'])->name('home');

//rute kontak
Route::get('/kontak', function () {
    return view('user.kontak');
})->name('kontak');
Route::post('/kontak', [App\Http\Controllers\ContactController::class, 'submit'])->name('kontak.submit');

//rute tentang
Route::get('/tentang', function () {
    return view('user.tentang');
})->name('tentang');

//rute artikel
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

// Hewan
Route::get('/hewan', [HewanController::class, 'index'])->name('hewan');
Route::get('/hewan/{id}', [HewanController::class, 'show'])->name('hewan.show');
 Route::get('/hewan/daftarkan', [HewanController::class, 'create'])->name('hewan.create');

Route::get('/panduan', function () {
        return view('panduan');
    })->name('panduan');


// --- RUTE YANG MEMBUTUHKAN LOGIN ---
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         $hewansTersedia = Hewan::where('status', 'tersedia')->get();
//         // Pastikan 'diadopsi' adalah status yang valid di model Hewan Anda
//         $hewansDiadopsi = Hewan::where('status', 'Sudah Diadopsi')->latest()->take(4)->get();
//          // Ambil artikel edukasi terbaru
//         $artikelEdukasi = Artikel::orderBy('created_at', 'desc')->take(3)->get();

//         return view('dashboard', compact('hewansTersedia', 'hewansDiadopsi', 'artikelEdukasi'));
//     })->name('dashboard.user');

Route::middleware(['auth'])->group(function () {
    // Halaman dashboard user
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard.user');
    // Halaman profil kustom (menampilkan info & riwayat adopsi user)
    Route::get('/profil', [UserProfileController::class, 'showProfile'])->name('profil');
    Route::get('/profil/edit', [UserProfileController::class, 'editProfile'])->name('edit_profil');
    Route::put('/profil/update', [UserProfileController::class, 'updateProfile'])->name('update_profil');
    Route::get('/adopsi-riwayat', [UserProfileController::class, 'showAdopsiHistory'])->name('adopsi.riwayat'); //riwayat adopsi

    // Daftarkan hewan
    Route::get('/daftarkanhewan', [HewanController::class, 'daftarkanHewanForm'])->name('daftarkanhewan.form');
    Route::post('/daftarkanhewan', [HewanController::class, 'store'])->name('daftarkanhewan.store');
    Route::get('/daftar-adopsi', function () {
    return view('user.daftarkanhewan'); 
    
});

    // --- RUTE ADOPSI ---
    Route::get('/adopsi/form/{hewan_id}', [AdopsiController::class, 'showAdopsiForm'])->name('adopsi.form');

    // Route untuk submit form  
    Route::post('/adopsi/submit', [AdopsiController::class, 'submitAdopsiForm'])->name('adopsi.submit');

    // Route untuk konfirmasi (DIPERBAIKI agar menerima ID Adopsi)
    Route::get('/adopsi/konfirmasi/{adopsi_id}', [AdopsiController::class, 'konfirmasi'])->name('adopsi.konfirmasi'); // DIKOREKSI: agar menerima {adopsi_id} dan mengarah ke controller
});

// --- RUTE ADMIN (Hanya untuk admin) ---
Route::get('/dashboard/admin', [DashboardController::class, 'userDashboard'])->name('dashboard.user');
Route::get('/titip/hewan',[AdopsiController::class, 'titipHewan'])->name('titip.hewan');
Route::post('/titip/hewan/store', [AdopsiController::class, 'titipHewanStore'])->name('titip.hewan.store');
Route::get('/dashboard/user', [DashboardController::class, 'index'])->name('dashboard.admin');
Route::get('/kelola/adopsi', [AdminAdopsiController::class, 'index'])->name('adopsi.index');
Route::get('/kelola/hewan', [AdminHewanController::class, 'index'])->name('hewan.index');
Route::get('/tambah/hewan', [AdminHewanController::class, 'create'])->name('hewan.create');
Route::post('/tambah/hewan', [AdminHewanController::class, 'store'])->name('hewan.store');
Route::get('/edit/hewan/{hewan}', [AdminHewanController::class, 'edit'])->name('hewan.edit');
Route::put('/update/hewan/{hewan}', [AdminHewanController::class, 'update'])->name('hewan.update');
Route::delete('/hewan/{hewan}', [AdminHewanController::class, 'destroy'])->name('hewan.destroy');
Route::get('/hewan/{hewan}', [AdminHewanController::class, 'show'])->name('hewan.show');
Route::patch('/adopsi/{id}/status', [AdminAdopsiController::class, 'updateStatus'])->name('adopsi.updateStatus');
Route::delete('/adopsi/{id}', [AdminAdopsiController::class, 'destroy'])->name('adopsi.destroy');
Route::get('/adopsi/create', [AdminAdopsiController::class, 'create'])->name('adopsi.create');
Route::post('/adopsi/store', [AdminAdopsiController::class, 'store'])->name('adopsi.store');
Route::post('/adopsi/{id}/approve', [AdminAdopsiController::class, 'approve'])->name('adopsi.approve');
Route::post('/adopsi/{id}/reject', [AdminAdopsiController::class, 'reject'])->name('adopsi.reject');

// Rute otentikasi Laravel Breeze (login, register, dsb.)
require __DIR__.'/auth.php';