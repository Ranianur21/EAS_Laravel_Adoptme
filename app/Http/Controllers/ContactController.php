<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255', // <<< INI YANG DIBENERIN: max=255 jadi max:255
            'message' => 'required|string',
        ]);

        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            Session::flash('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            Session::flash('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }

        return redirect()->route('kontak');
    }
}