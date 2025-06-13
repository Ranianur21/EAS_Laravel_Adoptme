<?php

namespace App\Http\Controllers;

use App\Models\Hewan; 
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

        return view('home', [
            'hewansTersedia' => $hewansTersedia,
            'hewansDiadopsi' => $hewansDiadopsi, // Tambahkan ini
        ]);
    }
}