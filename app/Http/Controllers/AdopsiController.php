<?php

namespace App\Http\Controllers;

use App\Models\Adopsi;
use App\Models\Hewan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdopsiController extends Controller
{
    /**
     * Menampilkan form adopsi
     */
    public function showAdopsiForm($hewan_id)
    {
        $hewan = Hewan::findOrFail($hewan_id);
        
        // Cek apakah hewan sudah diadopsi
        if ($hewan->status === 'Sudah Diadopsi') {
            return redirect()->route('hewan.index')
                ->with('error', 'Maaf, hewan ini sudah diadopsi.');
        }

        return view('adopsi.form', compact('hewan'));
    }

    /**
     * Memproses pengajuan adopsi
     */
    public function submitAdopsiForm(Request $request): RedirectResponse
    {
        try {
            // Validasi data
            $validated = $this->validateRequest($request);

            // Cek status hewan
            $hewan = Hewan::findOrFail($validated['hewan_id']);
            if ($hewan->status === 'Sudah Diadopsi') {
                throw ValidationException::withMessages([
                    'hewan' => 'Maaf, hewan ini sudah diadopsi.'
                ]);
            }

            // Proses dokumen
            $documentPaths = $this->processDocuments($request);

            // Buat pengajuan adopsi
            $adopsi = $this->createAdoption($validated, $documentPaths);

            // Update status hewan
            $hewan->status = 'Dalam Proses Adopsi';
            $hewan->save();

            return redirect()->route('adopsi.konfirmasi')
                ->with([
                    'success' => 'Pengajuan adopsi berhasil dikirim!',
                    'adopsi' => $adopsi
                ]);

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman konfirmasi
     */
    public function konfirmasi()
    {
        if (!session('success')) {
            return redirect()->route('dashboard');
        }

        $adopsi = session('adopsi');
        $adopsi->load(['hewan', 'user']);

        return view('adopsi.konfirmasi', compact('adopsi'));
    }

    /**
     * Validasi request
     */
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'hewan_id' => 'required|exists:hewans,id',
            'alasan' => 'required|string|min:20|max:1000',
            'surat_pernyataan' => 'required|file|mimes:pdf|max:2048',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'alasan.min' => 'Alasan adopsi minimal 20 karakter.',
            'surat_pernyataan.required' => 'Surat pernyataan wajib diunggah.',
            'ktp.required' => 'KTP wajib diunggah jika belum ada di profil.'
        ]);
    }

    /**
     * Proses upload dokumen
     */
    protected function processDocuments(Request $request): array
    {
        $user = Auth::user();
        $ktpPath = $user->path_foto_ktp;

        // Handle KTP
        if ($request->hasFile('ktp')) {
            // Hapus KTP lama jika ada
            if ($ktpPath && Storage::exists($ktpPath)) {
                Storage::delete($ktpPath);
            }
            
            $ktpPath = $request->file('ktp')->store('adopsi_dokumen/ktp', 'public');
            $user->path_foto_ktp = $ktpPath;
            $user->save();
        }

        if (!$ktpPath) {
            throw ValidationException::withMessages([
                'ktp' => 'Anda belum mengunggah KTP. Silakan unggah terlebih dahulu.'
            ]);
        }

        // Handle Surat Pernyataan
        $suratPath = $request->file('surat_pernyataan')->store('adopsi_dokumen/surat', 'public');

        return [
            'ktp' => $ktpPath,
            'surat' => $suratPath
        ];
    }

    /**
     * Membuat record adopsi
     */
    protected function createAdoption(array $validated, array $documentPaths): Adopsi
    {
        return Adopsi::create([
            'user_id' => Auth::id(),
            'hewan_id' => $validated['hewan_id'],
            'alasan' => $validated['alasan'],
            'path_ktp' => $documentPaths['ktp'],
            'path_surat_pernyataan' => $documentPaths['surat'],
            'status' => 'Menunggu Verifikasi',
        ]);
    }

    /**
     * Method untuk menampilkan pengajuan adopsi user (digunakan di UserProfileController)
     */
    public function showUserAdoptions()
    {
        $user = Auth::user();
        $adopsiPengajuan = $user->adopsi()->with('hewan')->get();
        
        return view('profile.adopsi', compact('adopsiPengajuan'));
    }
}
