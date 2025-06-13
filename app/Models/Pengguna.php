<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting: Ini yang membuat model bisa diotentikasi
use Illuminate\Notifications\Notifiable;


class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable; // <<-- HasApiTokens telah dihapus dari sini

    /**
     *
     * @var string
     */
    protected $table = 'pengguna';

    /**
     * Tentukan apakah model harus menggunakan kolom 'created_at' dan 'updated_at'.
     * Berdasarkan screenshot tabel Anda, Anda memiliki 'created_at'.
     *
     * Jika Anda juga memiliki kolom `updated_at` di tabel Anda:
     * public $timestamps = true; // (Ini adalah default, jadi Anda bisa menghapusnya)
     *
     * Jika Anda TIDAK memiliki kolom `updated_at` di tabel Anda:
     * public $timestamps = false; // <<<-- Anda harus menambahkan ini jika 'updated_at' tidak ada
     *
     * Saya asumsikan berdasarkan screenshot sebelumnya (yang tidak menunjukkan updated_at),
     * Anda mungkin belum punya. Jadi, saya akan sertakan baris untuk menonaktifkan timestamp jika tidak ada.
     * Silakan sesuaikan sesuai kondisi tabel Anda.
     */
    // public $timestamps = false; // Hapus komentar ini jika Anda TIDAK memiliki kolom 'updated_at' di tabel 'pengguna'

    /**
     * Atribut yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'alamat',      
        'umur',        
        'pekerjaan',   
        'no_telp',     
        'path_foto_ktp', 
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi (misalnya, saat model dikonversi ke array/JSON).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     * Penting untuk hashing password secara otomatis di Laravel 10+.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Jika Anda memiliki kolom 'email_verified_at', tambahkan ini:
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Ini akan menghash password secara otomatis saat disimpan (Laravel 10+)
    ];
}