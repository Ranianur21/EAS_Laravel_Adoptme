<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50 px-6">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <a href="{{ route('home') }}" class="text-2xl font-bold">AdoptMe</a>

        <div class="flex space-x-6 items-center">
            {{-- Pastikan rute 'home', 'tentang', 'hewan', 'kontak' sudah terdefinisi di routes/web.php --}}
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link>
            <x-nav-link href="{{ route('tentang') }}" :active="request()->routeIs('tentang')">Tentang</x-nav-link>
            <x-nav-link href="{{ route('hewan') }}" :active="request()->routeIs('hewan')">Hewan</x-nav-link>
            <x-nav-link href="{{ route('kontak') }}" :active="request()->routeIs('kontak')">Kontak</x-nav-link>

            {{-- Pastikan rute 'keranjang' terdefinisi --}}
            <a href="{{ route('keranjang') }}" class="relative">
                <img src="https://cdn-icons-png.flaticon.com/512/107/107831.png" alt="Keranjang" class="w-5 h-5">
                <span class="absolute -top-2 -right-2 bg-green-500 text-xs rounded-full px-1">0</span>
            </a>

            {{-- LOGIKA BARU UNTUK TAMPILAN LOGIN / USER INISIAL --}}

            @guest {{-- Jika pengguna BELUM login --}}
                <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
            @endguest

            @auth {{-- Jika pengguna SUDAH login --}}
                <div class="relative">
                    <button id="userDropdown" class="bg-white text-[#8b5e34] w-8 h-8 rounded-full font-bold focus:outline-none flex items-center justify-center">
                        {{-- Mengambil inisial nama depan --}}
                        {{ Str::upper(substr(Auth::user()->nama, 0, 1)) }}
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-300 text-gray-800">
                        {{-- Pastikan rute 'profil', 'toko', 'panduan' sudah terdefinisi --}}
                        <a href="{{ route('profil') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                        <a href="{{ route('toko') }}" class="block px-4 py-2 hover:bg-gray-100">Toko</a>
                        <a href="{{ route('panduan') }}" class="block px-4 py-2 hover:bg-gray-100">Panduan</a>
                        {{-- Form untuk Logout (POST request) --}}
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block px-4 py-2 text-[#8b5e34] hover:bg-gray-100 font-bold">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtn = document.getElementById("userDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");

        // Pastikan elemen ditemukan sebelum menambahkan event listener
        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener("click", function (event) {
                dropdownMenu.classList.toggle("hidden");
                event.stopPropagation();
            });

            document.addEventListener("click", function (event) {
                if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        }
    });
</script>