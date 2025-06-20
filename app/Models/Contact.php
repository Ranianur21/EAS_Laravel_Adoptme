<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari konvensi (opsional, tapi bagus untuk memastikan)
    protected $table = 'contacts';

    // Kolom-kolom yang boleh diisi secara massal (dari form)
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}