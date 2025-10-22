<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                'gambar' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'required' => 'Field wajib diisi.',
                'integer' => 'Usia harus berupa angka.',
                'mimes' => 'Format data tidak valid (harus berupa gambar).',
                'max' => 'Format/ukuran file tidak didukung (maks 2MB).',
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
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('hewan')->with('success', 'Hewan berhasil didaftarkan untuk diadopsi!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Kalau validasi gagal (test case 3, 4, 5)
            $errors = $e->validator->errors()->all();
            return back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            // Antisipasi error tak terduga
            return back()->with('error', 'Terjadi kesalahan pada sistem.');
        }
    }

    /**
     * Menampilkan detail satu hewan.
     */
    public function show($id): View
    {
        $hewan = Hewan::findOrFail($id);
        return view('user.hewan_detail', compact('hewan'));
    }
}
