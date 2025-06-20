<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Adopsi;

class UserProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna dengan informasi pribadi
     * dan riwayat pengajuan adopsi.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $user = Auth::user();

        // Mengambil riwayat pengajuan adopsi pengguna
        $riwayatAdopsi = $user->adopsiPengajuan()->with('hewan')->orderBy('created_at', 'desc')->get();

        // Mengembalikan view profil dan melewatkan variabel $user dan $riwayatAdopsi ke view tersebut
        return view('profil', compact('user', 'riwayatAdopsi'));
    }

    /**
     * Menampilkan halaman edit profil untuk pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        $user = Auth::user();
        // Menampilkan form edit profil dengan data pengguna saat ini
        return view('edit_profil', compact('user'));  // Pastikan path view sesuai
    }

    /**
     * Memperbarui profil pengguna yang sedang login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Validasi inputan pengguna
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'umur' => 'nullable|integer',
            'pekerjaan' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'path_foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Update data pengguna
        $user->update($validatedData);

        // Jika ada file foto KTP, upload ke storage
        if ($request->hasFile('path_foto_ktp')) {
            $file = $request->file('path_foto_ktp');
            $path = $file->store('public/ktp');
            $user->path_foto_ktp = $path;
            $user->save();
        }

        // Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan riwayat pengajuan adopsi pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function showAdopsiHistory()
    {
        $user = Auth::user();

        // Mengambil riwayat pengajuan adopsi
        $riwayatAdopsi = $user->adopsiPengajuan()->with('hewan')->orderBy('created_at', 'desc')->get();

        return view('user.adopsi.index', compact('riwayatAdopsi'));
    }
}
