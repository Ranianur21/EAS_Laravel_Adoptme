<x-guest-layout>
    <div class="bg-[#8b5e34] flex items-center justify-center h-screen">
        <div class="bg-white p-10 rounded-lg shadow-lg w-[450px] text-center relative">
            {{-- Tombol Tutup --}}
            <button onclick="window.location.href='{{ url('/') }}'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>

            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Reset Password <span class="text-[#8b5e34]">AdoptMe</span></h2>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Lupa password? Tidak masalah. Masukkan email kamu dan kami akan kirimkan tautan untuk mengatur ulang password.') }}
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col space-y-4">
                @csrf

                {{-- Email Address --}}
                <input type="email" name="email" placeholder="Masukkan Email" required
                    class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]"
                    value="{{ old('email') }}" autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition">
                    {{ __('Kirim Tautan Reset Password') }}
                </button>
            </form>

            <p class="text-md text-gray-600 mt-5">
                Sudah ingat password? <a href="{{ route('login') }}" class="text-[#8b5e34] font-semibold">Login</a>
            </p>
        </div>
    </div>
</x-guest-layout>
