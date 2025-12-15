<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hewan;
use App\Models\Adopsi;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AdminAdopsiController extends Controller
{
    public function index()
{
    // Mengambil data Adopsi dan memuat relasi Pengguna
    $adopsi = Adopsi::with('user') // Memuat relasi pengguna
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

    // Mengirim data ke view
    return view('admin.kelola-adopsi.index', compact('adopsi'));
}

public function create()
{
    // Mengambil data hewan yang statusnya 'Tersedia'
    $hewan = Hewan::where('status', 'Tersedia')->get();
    
    // Mengambil data pengguna
    $pengguna = User::all();

    // Menampilkan form tambah adopsi dengan data hewan dan pengguna
    return view('admin.kelola-adopsi.create', compact('hewan', 'pengguna'));
}

public function store(Request $request)
{
    // dd($request->all());
    // Validasi input data
    $request->validate([
        'hewan_id' => 'required|exists:hewan,id',
        'pengguna_id' => 'required|exists:users,id',
    ]);

    // Menyimpan data adopsi
    $adopsi = new Adopsi();
    $adopsi->hewan_id = $request->hewan_id;
    $adopsi->pengguna_id = $request->pengguna_id;
    $adopsi->status = 'Menunggu Konfirmasi'; 
    $adopsi->created_at = now();
    $adopsi->updated_at = now();
    $adopsi->save();

    // Redirect dengan pesan sukses
    return redirect()->route('adopsi.index')->with('success', 'Adopsi berhasil ditambahkan!');
}


public function updateStatus(Request $request, $id)
{
    $adopsi = Adopsi::findOrFail($id);
    $adopsi->status = $request->status;
    $adopsi->save();
    
    return redirect()->back()->with('success', 'Status berhasil diperbarui!');
}

public function destroy($id)
{
    $adopsi = Adopsi::findOrFail($id);
    $adopsi->delete();
    
    return redirect()->back()->with('success', 'Data adopsi berhasil dihapus!');
}

public function approve($id) {
    $adopsi = Adopsi::findOrFail($id);
    $adopsi->status = 'Disetujui';
    $adopsi->save();
    return redirect()->route('adopsi.index')->with('success', 'Adopsi berhasil disetujui');
}

public function reject($id) {
    $adopsi = Adopsi::findOrFail($id);
    $adopsi->status = 'Ditolak';
    $adopsi->save();
    return redirect()->route('adopsi.index')->with('success', 'Adopsi berhasil ditolak');
}

}
