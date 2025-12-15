<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $artikel->title }} | AdoptMe</title> {{-- SESUAIKAN: Gunakan 'title' --}}
</head>
<x-navbar></x-navbar> {{-- Ini untuk Navbar Anda --}}
<body class="bg-white text-gray-900">

<header class="bg-white shadow-md py-10 text-[#8b5e34] text-center">
    <h1 class="text-4xl font-bold">Artikel Edukasi</h1>
</header>

<section class="container mx-auto py-12 px-6">
  <article class="bg-white p-8 rounded-lg shadow-md border border-[#8b5e34] overflow-hidden"> {{-- TAMBAHKAN overflow-hidden DI SINI --}}
        {{-- SESUAIKAN: Tampilkan judul dari kolom 'title' --}}
        <h1 class="text-3xl font-bold text-[#4a2c1f] mb-4">{{ $artikel->title }}</h1>
        <p class="text-gray-600 text-sm mb-2">
            Oleh: <span class="font-semibold">{{ $artikel->author_name ?? 'Tim AdoptMe' }}</span> |
            Dipublikasikan: <span class="font-semibold">{{ $artikel->created_at->format('d M Y') }}</span>
        </p>

        @if($artikel->image_url)
            <img src="{{ asset('assets/images/' . $artikel->image_url) }}">
                 alt="{{ $artikel->title }}"
                 class="max-w-xl h-auto object-cover rounded-lg mb-6 mx-auto block"> {{-- max-w-xl untuk lebar, h-auto untuk tinggi otomatis, mx-auto block untuk tengah --}}
        @endif

        <div class="prose max-w-none text-gray-800 leading-relaxed text-justify">
            {{-- SESUAIKAN: Tampilkan konten dari kolom 'content' --}}
            {!! nl2br(e($artikel->content)) !!}
        </div>

        <div class="mt-8">
            <a href="{{ route('artikel.index') }}" class="inline-block bg-[#8b5e34] text-white px-6 py-2 rounded-lg hover:bg-[#6b3f21] transition duration-300">
                &larr; Kembali ke Daftar Artikel
            </a>
        </div>
    </article>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>
</body>
</html>