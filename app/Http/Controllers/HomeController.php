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
                               ->limit(6) // Sesuaikan limit sesuai kebutuhan Anda
                               ->get();

        $hewansDiadopsi = Hewan::where('status', 'diadopsi')->get();

        // PENTING: Controller harus merender 'home' (yaitu resources/views/home.blade.php)
        return view('home', [ 
            'hewansTersedia' => $hewansTersedia,
            'hewansDiadopsi' => $hewansDiadopsi,
        ]);
    }
}