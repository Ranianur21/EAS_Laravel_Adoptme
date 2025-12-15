<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Artikel Edukasi | AdoptMe</title>
</head>
<x-navbar></x-navbar> {{-- Ini untuk Navbar Anda --}}
<body class="bg-white text-gray-900">

<header class="bg-white shadow-md py-10 text-[#8b5e34] text-center">
    <h1 class="text-4xl font-bold">Artikel Edukasi</h1>
    <p class="mt-2 text-lg">Wawasan seputar perawatan dan adopsi hewan</p>
</header>

<section class="container mx-auto py-12 px-6">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($artikels as $artikel)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-[#8b5e34]">
                <img src="{{ asset('assets/images/' . $artikel->image_url) }}"alt="{{ $artikel->title }}"class="w-full h-48 object-cover">
                <div class="p-6">
                    {{-- SESUAIKAN: Tampilkan judul dari kolom 'title' --}}
                    <h3 class="text-xl font-bold text-[#8b5e34] mb-2">{{ $artikel->title }}</h3>
                    {{-- Jika Anda tidak memiliki kolom 'kategori' di DB, HAPUS baris di bawah ini --}}
                    {{-- <p class="text-gray-600 text-sm mb-4">Kategori: {{ $artikel->kategori ?? 'Umum' }}</p> --}}
                    {{-- SESUAIKAN: Tampilkan ringkasan dari kolom 'excerpt' --}}
                    <p class="text-gray-700 text-sm">{{ $artikel->excerpt }}</p>
                    {{-- Link ke halaman detail artikel --}}
                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="mt-4 inline-block bg-[#8b5e34] text-white px-4 py-2 rounded-lg hover:bg-[#6b3f21] transition duration-300">Baca Selengkapnya</a>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada artikel edukasi yang tersedia saat ini.</p>
        @endforelse
    </div>
</section>

<<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>
</body>
</html>