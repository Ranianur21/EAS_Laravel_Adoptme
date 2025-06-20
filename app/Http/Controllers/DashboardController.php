<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hewan;
use App\Models\Adopsi;
use App\Models\Artikel;
use App\Models\Pengguna;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengguna = User::count();
        $totalHewan = Hewan::count();
        $totalAdopsi = Adopsi::count();

        return view('admin.dashboard-admin.index', compact('totalPengguna', 'totalHewan', 'totalAdopsi'));
    }

    public function userDashboard()
    {
        // dd(Auth::user());
        $hewansTersedia = Hewan::where('status', 'tersedia')->get();
        // Pastikan 'diadopsi' adalah status yang valid di model Hewan Anda
        $hewansDiadopsi = Hewan::where('status', 'Sudah Diadopsi')->latest()->take(4)->get();
         // Ambil artikel edukasi terbaru
        $artikelEdukasi = Artikel::orderBy('created_at', 'desc')->take(3)->get();

        return view('dashboard', compact('hewansTersedia', 'hewansDiadopsi', 'artikelEdukasi'));

    }
}
