<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User; 

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'min:17'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:20', 'regex:/^\d+$/'],
            'upload_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'umur.min' => 'Umur minimal 17 tahun.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'upload_ktp.required' => 'Foto KTP wajib diunggah.',
            'upload_ktp.image' => 'File harus berupa gambar.',
            'upload_ktp.mimes' => 'Format gambar yang diizinkan adalah JPEG, PNG, JPG.',
            'upload_ktp.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
        ];
    }
}