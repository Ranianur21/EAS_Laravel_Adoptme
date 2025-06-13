<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna; // Pastikan menggunakan model Pengguna Anda
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Penting: Import Request
use Illuminate\Support\Facades\Storage; // Penting: Import Storage

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; // Sesuaikan kemana setelah register sukses

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Validasi ini akan dijalankan saat form disubmit (di langkah terakhir)
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna'], // Pastikan unique:pengguna
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'min:17'], // Validasi umur minimal 17
            'pekerjaan' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:15'], // Sesuaikan validasi no telp (misal: regex)
            'upload_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validasi file KTP (maks 2MB)
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Pengguna
     */
    protected function create(array $data)
    {
        $pathFotoKtp = null;
        // Cek apakah ada file KTP yang diupload
        if (isset($data['upload_ktp'])) {
            // Simpan file KTP ke direktori 'public/ktp_uploads'
            // Pastikan Anda sudah menjalankan `php artisan storage:link`
            $path = $data['upload_ktp']->store('public/ktp_uploads');
            // Dapatkan URL publik untuk disimpan di database
            $pathFotoKtp = Storage::url($path); 
        }

        return Pengguna::create([ // Gunakan model Pengguna
            'nama' => $data['nama_lengkap'], // Mapping 'nama_lengkap' dari form ke kolom 'nama' di tabel
            'email' => $data['email'],
            // Password akan otomatis di-hash karena 'password' di-cast ke 'hashed' di model Pengguna
            'password' => $data['password'], 
            'role' => 'user', // Set default role sebagai 'user'
            'alamat' => $data['alamat'],
            'umur' => $data['umur'],
            'pekerjaan' => $data['pekerjaan'],
            'no_telp' => $data['no_telp'],
            'path_foto_ktp' => $pathFotoKtp, // Simpan path KTP
            // 'status_verifikasi' => 'pending', // Jika Anda menambahkan kolom status verifikasi
        ]);
    }
}