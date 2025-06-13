<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AdoptMe</title>
     @vite('resources/css/app.css')
</head>
<body class="bg-[#8b5e34] flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-lg shadow-lg w-[450px] text-center relative">
        <button onclick="window.location.href='{{ url('/') }}'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>

        <h2 class="text-3xl font-semibold text-gray-700 mb-6">Login<span class="text-[#8b5e34]"> AdoptMe</span></h2>

        {{-- kalo eror --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    {{-- "jika sukses" --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-4">
            @csrf {{-- Penting untuk keamanan CSRF --}}

            <input type="email" name="email" placeholder="Masukkan Email" required
                   class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]"
                   value="{{ old('email') }}"> {{-- Mempertahankan input email jika ada error validasi --}}

            <input type="password" name="password" placeholder="Masukkan Password" required
                   class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">

            <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition">Login</button>
        </form>

        <p class="text-md text-gray-600 mt-5">Belum punya akun? <a href="{{ route('register') }}" class="text-[#8b5e34] font-semibold">Daftar di sini</a></p>
    </div>
</body>
</html>