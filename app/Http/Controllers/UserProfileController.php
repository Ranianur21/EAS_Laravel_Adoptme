<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan pengguna yang sedang login
use App\Models\User;
use App\Models\Adopsi; // Mengacu pada model Adopsi Anda (walaupun tidak langsung dipakai di sini, relasi yang menggunakannya)
use App\Models\Hewan; // Mengacu pada model Hewan Anda (walaupun tidak langsung dipakai, relasi yang menggunakannya)


class UserProfileController extends Controller
{
    /** @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     * Menampilkan halaman profil pengguna dengan informasi pribadi
     * dan riwayat pengajuan adopsi.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        
        $user = Auth::user();

    
        $riwayatAdopsi = $user->adopsiPengajuan()->with('hewan')->orderBy('created_at', 'desc')->get();

        // Mengembalikan view 'profil' (resources/views/profil.blade.php)
        // dan melewatkan variabel $user dan $riwayatAdopsi ke view tersebut.
        return view('profil', compact('user', 'riwayatAdopsi'));
    }

     public function adopsiPengajuan()
    {
        $adopsiController = new AdopsiController();
        return $adopsiController->showUserAdoptions();
    }
    // Anda bisa menambahkan method lain di sini jika diperlukan,
    // misalnya untuk update informasi profil kustom yang berbeda dari Breeze ProfileController.
}