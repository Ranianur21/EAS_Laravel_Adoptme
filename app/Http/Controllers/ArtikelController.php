<?php

namespace App\Http\Controllers;

use App\Models\Artikel; // PENTING: Import model Artikel Anda
use Illuminate\Http\Request; // Ini biasanya sudah ada

class ArtikelController extends Controller
{
    // Fungsi untuk menampilkan daftar semua artikel
    public function index()
    {
        // Ambil semua data dari tabel 'articles', urutkan berdasarkan tanggal terbaru
        $artikels = Artikel::orderBy('created_at', 'desc')->get();

        // Kirim data $artikels ke view 'user.artikel.index'
        return view('user.artikel.index', compact('artikels'));
    }

    // Fungsi untuk menampilkan detail satu artikel
    // '$slug' akan otomatis diisi dari URL (misal: /artikel/manfaat-adopsi)
    public function show($slug)
    {
        // Cari artikel berdasarkan kolom 'slug' yang unik.
        // firstOrFail() akan menampilkan halaman 404 jika tidak ditemukan.
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        // Kirim data $artikel ke view 'user.artikel.show'
        return view('user.artikel.show', compact('artikel'));
    }
}