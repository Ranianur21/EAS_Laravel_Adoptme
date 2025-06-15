<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        
        $pathKtp = null;
        if ($request->hasFile('upload_ktp')) {
            $pathKtp = $request->file('upload_ktp')->store('path_foto_ktp', 'public');
        }

        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'pekerjaan' => $request->pekerjaan,
            'no_telp' => $request->no_telp, 
            'path_foto_ktp' => $pathKtp, 
            'role' => 'user', 
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Anda bisa tambahkan flash message sukses di sini
        return redirect(RouteServiceProvider::HOME)->with('success', 'Registrasi berhasil! Selamat datang di AdoptMe.');
    }
}