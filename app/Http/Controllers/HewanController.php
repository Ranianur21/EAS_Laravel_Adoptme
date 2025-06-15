<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HewanController extends Controller
{
    /**
     * Menampilkan semua hewan yang tersedia untuk adopsi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $queryTersedia = Hewan::where('status', 'tersedia');

        if ($request->has('jenis') && $request->input('jenis') !== 'Semua') {
            $queryTersedia->where('jenis', $request->input('jenis'));
        }

        $hewansTersedia = $queryTersedia->orderBy('created_at', 'desc')->get();

        $hewansDiadopsi = Hewan::where('status', 'diadopsi')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('user.hewan', compact('hewansTersedia', 'hewansDiadopsi'));
    }

    /**
     * Menampilkan form untuk pengguna yang ingin mendaftarkan hewan mereka.
     *
     * @return \Illuminate\View\View
     */
    public function daftarkanHewanForm()
{
    return view('user.daftarkanhewan');
}
    /**
     * Menyimpan data hewan baru yang diajukan pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:Anjing,Kucing,Kelinci',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'required|integer|min:0|max:30',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar ke storage/app/public/gambar_hewan
        $path = $request->file('gambar')->store('gambar_hewan', 'public');

        Hewan::create([
            'nama' => $request->input('nama'),
            'jenis' => $request->input('jenis'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'usia' => $request->input('usia'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' => basename($path),
            'status' => 'tersedia',
            'user_id' => Auth::id(), // Jika ada sistem user login
        ]);

        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil didaftarkan untuk diadopsi!');
    }
}
