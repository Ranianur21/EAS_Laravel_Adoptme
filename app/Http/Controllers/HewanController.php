<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HewanController extends Controller
{
    /**
     * Menampilkan semua hewan yang tersedia untuk adopsi.
     */
    public function index(Request $request)
    {
        $queryTersedia = Hewan::where('status', 'tersedia');

        if ($request->has('jenis') && $request->input('jenis') !== 'Semua') {
            $queryTersedia->where('jenis', $request->input('jenis'));
        }

        $hewansTersedia = $queryTersedia->orderBy('created_at', 'desc')->get();
        $hewansDiadopsi = Hewan::where('status', 'diadopsi')->orderBy('updated_at', 'desc')->get();

        return view('user.hewan', compact('hewansTersedia', 'hewansDiadopsi'));
    }

    /**
     * Menampilkan form daftarkan hewan.
     */
    public function daftarkanHewanForm()
    {
        return view('user.daftarkanhewan');
    }

    /**
     * Menyimpan data hewan baru yang diajukan pengguna.
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:Anjing,Kucing,Kelinci',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'required|integer|min:0|max:30',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 🔥 NAMA FILE
        $namaFile = time().'_'.$request->file('gambar')->getClientOriginalName();

        // 🔥 PINDAH KE public/assets/images/gambar_hewan
        $request->file('gambar')->move(
            public_path('assets/images/gambar_hewan'),
            $namaFile
        );

        Hewan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaFile, // cuma nama file
            'status' => 'tersedia',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('hewan')->with('success', 'Hewan berhasil ditambahkan');
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}

    public function show($id): View
    {
        $hewan = Hewan::findOrFail($id);
        return view('user.hewan_detail', compact('hewan'));
    }
}