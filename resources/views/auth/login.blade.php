
<x-guest-layout> 


    <div class="bg-[#8b5e34] flex items-center justify-center h-screen"> {{-- Tambahkan kembali styling background dan centering --}}

        <div class="bg-white p-10 rounded-lg shadow-lg w-[450px] text-center relative">
            {{-- Tombol Tutup --}}
            <button onclick="window.location.href='{{ url('/') }}'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>

            <h2 class="text-3xl font-semibold text-gray-700 mb-6">Login<span class="text-[#8b5e34]"> AdoptMe</span></h2>

            {{-- Menampilkan pesan error dari Laravel secara terintegrasi dengan Breeze components --}}
            {{-- Ini adalah pengganti bagian @if ($errors->any()) Anda --}}
            <x-auth-session-status class="mb-4" :status="session('status')" /> {{-- Untuk session status seperti "Anda telah logout" --}}

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- "jika sukses" (Laravel Breeze biasanya menggunakan session status, tapi ini bisa tetap dipertahankan jika ada kasus spesifik) --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-4">
                @csrf

                {{-- Email Address --}}
                {{-- Menggunakan input biasa Anda dengan styling kustom --}}
                <input type="email" name="email" placeholder="Masukkan Email" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]"
                       value="{{ old('email') }}" autofocus autocomplete="username">
                {{-- Menampilkan error spesifik untuk email menggunakan x-input-error --}}
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                {{-- Password --}}
                {{-- Menggunakan input biasa Anda dengan styling kustom --}}
                <input type="password" name="password" placeholder="Masukkan Password" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]"
                       autocomplete="current-password">
                {{-- Menampilkan error spesifik untuk password menggunakan x-input-error --}}
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                 @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-2 block" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
                 @endif

                <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition">Login</button>
            </form>

            <p class="text-md text-gray-600 mt-5">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#8b5e34] font-semibold">Daftar di sini</a>
            </p>
        </div>
    </div>
</x-guest-layout>