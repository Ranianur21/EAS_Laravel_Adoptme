<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Artikel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hewansTersedia = Hewan::where('status', 'tersedia')
                               ->orderBy('created_at', 'desc')
                               ->limit(3) 
                               ->get();

        $hewansDiadopsi = Hewan::where('status', 'diadopsi')->get();
        $artikelEdukasi = Artikel::orderBy('created_at', 'desc')->take(3)->get();

        return view('home', [ 
            'hewansTersedia' => $hewansTersedia,
            'hewansDiadopsi' => $hewansDiadopsi,
            'artikelEdukasi' => $artikelEdukasi
        ]);
    }
}