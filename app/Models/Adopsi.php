<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    use HasFactory;

    protected $table = 'adopsi';

    protected $fillable = [
        'user_id',
        'hewan_id',
        'alasan', // ditambahkan agar alasan tersimpan
        'path_foto_ktp', // kolom untuk path file KTP
        'path_surat_pernyataan', // kolom untuk path surat
        'status',
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke hewan
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id');
    }
}
