<?php

namespace App\Http\Controllers;

use App\Models\Hewan; // Import model Hewan
use Illuminate\Http\Request;

class HewanController extends Controller
{
    /**
     * Menampilkan semua hewan yang tersedia untuk adopsi.
     * Termasuk logika filter jika ada parameter di URL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 1. Query untuk Hewan yang Tersedia (dengan filter)
        $queryTersedia = Hewan::where('status', 'tersedia');

        if ($request->has('jenis') && $request->input('jenis') !== 'Semua') {
            $queryTersedia->where('jenis', $request->input('jenis'));
        }

        $hewansTersedia = $queryTersedia->orderBy('created_at', 'desc')->get();

        // 2. Query untuk Hewan yang Sudah Diadopsi (tanpa filter 'jenis' dari request ini, karena biasanya hewan diadopsi tidak difilter berdasarkan jenis di daftar adopsi)
        $hewansDiadopsi = Hewan::where('status', 'diadopsi')
                                ->orderBy('updated_at', 'desc') // Bisa diurutkan berdasarkan kapan diadopsi
                                ->get();

        // Teruskan kedua koleksi data ke view
        return view('user.hewan', compact('hewansTersedia', 'hewansDiadopsi'));
    }
}