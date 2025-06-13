<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting untuk otentikasi Laravel
use App\Models\Pengguna; // Penting untuk mengakses model Pengguna Anda

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     * Ini yang akan dipanggil saat user mengakses /login (GET request)
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Mengembalikan view login.blade.php
    }

    /**
     * Menangani proses login.
     * Ini yang akan dipanggil saat user mengirim form login (POST request ke /login)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => '⚠️ Email wajib diisi!',
            'email.email' => '⚠️ Format email tidak valid!',
            'password.required' => '⚠️ Password wajib diisi!',
        ]);

        $credentials = $request->only('email', 'password');

        // Percobaan otentikasi menggunakan Auth::attempt()
        // Ini akan mencari pengguna di database melalui model Pengguna,
        // memverifikasi password, dan jika berhasil, mengelola sesi.
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Dapatkan objek pengguna yang berhasil login

            // Simpan peran pengguna ke sesi untuk middleware dan akses mudah
            $request->session()->put('role', $user->role);

            // Arahkan pengguna berdasarkan perannya
            if ($user->role === 'admin') {
                // Redirect ke dashboard admin dan berikan flash message
                return redirect()->intended('/admin/dashboard')->with('success', '✅ Login berhasil sebagai Admin!');
            } else {
                // Redirect ke halaman utama untuk pengguna biasa
                return redirect()->intended('/')->with('success', '✅ Login berhasil!');
            }
        }

        // Jika otentikasi gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => '⚠️ Email atau password salah!', // Pesan error jika kredensial tidak cocok
        ])->onlyInput('email'); // Mempertahankan input email yang sebelumnya dimasukkan
    }

    /**
     * Menangani proses logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        $request->session()->invalidate(); // Invalidasi sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/')->with('success', 'Anda telah logout.'); // Redirect ke halaman utama
    }
}