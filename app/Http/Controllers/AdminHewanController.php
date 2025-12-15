<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;

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
        $request->validate([
            'nama'          => 'required|string|max:100',
            'jenis'         => 'required|string|max:50',
            'usia'          => 'required|numeric|min:0',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'deskripsi'     => 'nullable|string',
            'status'        => 'required|in:Tersedia,Diadopsi',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $namaFile = null;

        if ($request->hasFile('gambar')) {
            $namaFile = time().'_'.$request->file('gambar')->getClientOriginalName();

            $request->file('gambar')->move(
                public_path('assets/images/gambar_hewan'),
                $namaFile
            );
        }

        Hewan::create([
            'nama'          => $request->nama,
            'jenis'         => $request->jenis,
            'usia'          => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi'     => $request->deskripsi,
            'status'        => $request->status,
            'gambar'        => $namaFile, // SIMPAN NAMA FILE SAJA
        ]);

        return redirect()->route('hewan.index')
            ->with('success', 'Hewan berhasil ditambahkan!');
    }

    public function edit(Hewan $hewan)
    {
        return view('admin.kelola-hewan.edit', compact('hewan'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'jenis'         => 'required|string|max:50',
            'usia'          => 'required|numeric|min:0',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'deskripsi'     => 'nullable|string',
            'status'        => 'required|in:Tersedia,Diadopsi',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only([
            'nama', 'jenis', 'usia', 'jenis_kelamin', 'deskripsi', 'status'
        ]);

        if ($request->hasFile('gambar')) {

            // HAPUS GAMBAR LAMA
            if ($hewan->gambar && file_exists(
                public_path('assets/images/gambar_hewan/' . $hewan->gambar)
            )) {
                unlink(public_path('assets/images/gambar_hewan/' . $hewan->gambar));
            }

            // SIMPAN GAMBAR BARU
            $namaFile = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(
                public_path('assets/images/gambar_hewan'),
                $namaFile
            );

            $data['gambar'] = $namaFile;
        }

        $hewan->update($data);

        return redirect()->route('hewan.index')
            ->with('success', 'Hewan berhasil diperbarui!');
    }

    public function destroy(Hewan $hewan)
    {
        // 🔥 HAPUS DATA ADOPSI TERKAIT (ANTI FK ERROR)
        if (method_exists($hewan, 'adopsi') && $hewan->adopsi()->exists()) {
            $hewan->adopsi()->delete();
        }

        // 🔥 HAPUS FILE GAMBAR
        if ($hewan->gambar && file_exists(
            public_path('assets/images/gambar_hewan/' . $hewan->gambar)
        )) {
            unlink(public_path('assets/images/gambar_hewan/' . $hewan->gambar));
        }

        // 🔥 HAPUS DATA HEWAN
        $hewan->delete();

        return redirect()->route('hewan.index')
            ->with('success', 'Hewan berhasil dihapus!');
    }

    public function show(Hewan $hewan)
    {
        return view('admin.kelola-hewan.show', compact('hewan'));
    }
}
