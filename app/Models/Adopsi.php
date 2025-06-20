<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    use HasFactory;

    protected $table = 'adopsi';
    
    // // Disable timestamps karena tabel tidak memiliki created_at dan updated_at
    // public $timestamps = false;

    protected $fillable = [
        'user_id',
        'hewan_id',
        'alasan',
        'ktp',
        'surat_pernyataan',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
}