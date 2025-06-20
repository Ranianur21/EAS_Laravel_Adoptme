<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHewanController extends Controller
{
    public function index()
    {
        $hewan = Hewan::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.kelola-hewan.index', compact('hewan'));
    }


    public function create()
    {
        return view('admin.kelola-hewan.create');
    }

       public function store(Request $request)
{
    // Validasi input data dari form
    $request->validate([
        'nama' => 'required|string|max:100',
        'jenis' => 'required|string|max:50',
        'usia' => 'required|numeric|min:0',
        'jenis_kelamin' => 'required|in:Jantan,Betina',  // Validasi jenis kelamin
        'deskripsi' => 'nullable|string',
        'status' => 'required|in:Tersedia,Diadopsi', // Validasi status
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // Validasi gambar
    ]);

    // Proses penyimpanan gambar jika ada
    if ($request->hasFile('gambar')) {
        $imagePath = $request->file('gambar')->store('gambar_hewan', 'public');  // Menyimpan gambar di folder 'hewan' dalam 'public' disk
    } else {
        $imagePath = null;  // Jika tidak ada gambar, set ke null
    }

    // Simpan data ke dalam tabel 'hewan' menggunakan Eloquent
    Hewan::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'usia' => $request->usia,
        'jenis_kelamin' => $request->jenis_kelamin,
        'deskripsi' => $request->deskripsi,
        'status' => $request->status,
        'gambar' => basename($imagePath),  // Menyimpan nama file gambar
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('hewan.index')->with('success', 'Hewan berhasil ditambahkan!');
}



    public function edit(Hewan $hewan)
    {
        return view('admin.kelola-hewan.edit', compact('hewan'));
    }

    public function update(Request $request, Hewan $hewan)
{
    // Validasi input data dari form
    $request->validate([
        'nama' => 'required|string|max:100',
        'jenis' => 'required|string|max:50',
        'usia' => 'required|numeric|min:0',
        'jenis_kelamin' => 'required|in:Jantan,Betina', 
        'deskripsi' => 'nullable|string',
        'status' => 'required|in:Tersedia,Diadopsi',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    // Menyiapkan data untuk diperbarui
    $data = $request->only([
        'nama', 'jenis', 'usia', 'jenis_kelamin', 'deskripsi', 'status'
    ]);

    // Proses upload gambar jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($hewan->gambar && file_exists(storage_path('app/public/gambar_hewan/' . $hewan->gambar))) {
            unlink(storage_path('app/public/gambar_hewan/' . $hewan->gambar));
        }
        // Simpan gambar baru
        $imagePath = $request->file('gambar')->store('gambar_hewan', 'public');
        $data['gambar'] = basename($imagePath);
    }

    // Update data hewan di database
    $hewan->update($data);

    // Redirect ke halaman daftar hewan dengan pesan sukses
    return redirect()->route('hewan.index')->with('success', 'Hewan berhasil diperbarui!');
}

    public function destroy(Hewan $hewan)
{
    // Menghapus gambar jika ada
    if ($hewan->gambar && file_exists(storage_path('app/public/' . $hewan->gambar))) {
        unlink(storage_path('app/public/' . $hewan->gambar));  // Hapus file gambar
    }

    // Menghapus data hewan
    $hewan->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('hewan.index')->with('success', 'Hewan berhasil dihapus!');
}

    public function show(Hewan $hewan)
    {
        return view('admin.kelola-hewan.show', compact('hewan'));
    }
}