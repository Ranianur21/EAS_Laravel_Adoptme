<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'umur',
        'pekerjaan',
        'no_telp',
        'path_foto_ktp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'umur' => 'integer',
    ];

    /**
     * Relasi ke tabel adopsi
     * 
     * @return HasMany<Adopsi>
     */
    public function adopsi(): HasMany
    {
        return $this->hasMany(Adopsi::class);
    }

    /**
     * Alias untuk relasi adopsi (bisa dihapus jika tidak diperlukan)
     * 
     * @return HasMany<Adopsi>
     */
    public function adopsiPengajuan(): HasMany
    {
        return $this->adopsi(); // Menggunakan relasi yang sama
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user sudah mengunggah KTP
     */
    public function hasKTP(): bool
    {
        return !empty($this->path_foto_ktp);
    }
}