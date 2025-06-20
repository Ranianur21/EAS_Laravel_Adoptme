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
    if (Auth::attempt($credentials)) {
        // Regenerate session untuk keamanan
        $request->session()->regenerate();
        
        $user = Auth::user();
        
        // DEBUG: Cek nilai role (hapus setelah masalah teratasi)
        \Log::info('User Login Debug', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'role_type' => gettype($user->role)
        ]);
        
        // Simpan peran pengguna ke sesi
        $request->session()->put('role', $user->role);

        // Pastikan role dalam bentuk string dan trim whitespace
        $userRole = trim(strtolower($user->role));

        // Arahkan pengguna berdasarkan perannya
        if ($userRole === 'admin') {
            // Redirect ke dashboard admin
            return redirect()->route('dashboard.admin')
                           ->with('success', '✅ Login berhasil sebagai Admin!');
        } elseif ($userRole === 'user') {
            // Redirect ke dashboard user
            return redirect()->route('dashboard.user')
                           ->with('success', '✅ Login berhasil sebagai User!');
        } else {
            // Jika role tidak dikenali, logout dan redirect dengan error
            Auth::logout();
            return redirect()->route('login')
                           ->with('error', '❌ Role pengguna tidak valid: ' . $user->role);
        }
    }

    // Jika otentikasi gagal
    return back()->withErrors([
        'email' => '⚠️ Email atau password salah!',
    ])->onlyInput('email');
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