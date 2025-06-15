<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hewan extends Model
{
    protected $table = 'hewan';
    
    protected $fillable = [
        'nama',
        'jenis',
        'usia',
        'jenis_kelamin',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $casts = [
        'usia' => 'integer',
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
     * Scope untuk hewan yang tersedia (belum diadopsi)
     */
    public function scopeTersedia($query)
    {
        return $query->where('status', '!=', 'Sudah Diadopsi');
    }
}