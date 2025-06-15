    <header class="bg-[#8b5e34] text-white py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-6">
            <div class="text-center md:text-left md:w-1/2">
                <h1 class="text-5xl font-bold text-white">Selamat Datang di AdoptMe</h1>
                <p class="mt-3 text-lg">Temukan sahabat setia Anda dan berikan mereka rumah penuh kasih</p>
                <a href="{{ route('hewan') }}" class="mt-6 inline-block bg-[#d9a36a] text-white px-6 py-3 rounded-lg shadow-md hover:bg-[#c48950]">
                    Jelajahi Hewan
                </a>
            </div>
            <div class="mt-6 md:mt-0 md:w-1/2 flex justify-center">
                <div class="relative w-96 h-72 overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('images/h1.png') }}" alt="Hewan Adopsi" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </header>

    <section class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#8b5e34]">AdoptMe</h2>
            <p class="text-gray-600 mt-4 text-justify">
                AdoptMe adalah platform yang menghubungkan hewan peliharaan yang membutuhkan rumah dengan calon adopter yang peduli...
            </p>
        </div>
    </section>

    {{-- Hewan Tersedia --}}
    <section class="container mx-auto py-16 text-center">
        <h2 class="text-4xl font-bold text-[#4a2c1f]">Hewan yang Tersedia untuk Adopsi</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mt-4 mb-10">Berbagai hewan menggemaskan yang siap diadopsi...</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($hewansTersedia->take(4) as $hewan)
                <div class="hewan-item bg-white p-6 border border-[#8b5e34] rounded-lg shadow-md hover:scale-105">
                    <div class="w-full h-56 flex items-center justify-center">
                        <img src="{{ asset('storage/gambar_hewan/' . $hewan->gambar) }}" class="object-contain rounded-md h-full w-full">
                    </div>
                    <h3 class="text-xl font-bold text-[#8b5e34] mt-3">{{ $hewan->nama }}</h3>
                    <p class="text-sm text-gray-600">{{ $hewan->jenis_kelamin }}, {{ $hewan->usia }} tahun</p>
                    <p class="text-sm text-gray-700 mt-2">{!! nl2br(e($hewan->deskripsi)) !!}</p>
                    <div class="mt-4">
                        @auth
                            <a href="{{ route('adopsi.form', ['hewan_id' => $hewan->id]) }}" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Adopsi</a>
                        @else
                            <button onclick="showLoginModal()" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Adopsi</button>
                        @endauth
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Belum ada hewan yang tersedia.</p>
            @endforelse
        </div>

        <a href="{{ route('hewan') }}" class="mt-8 inline-block bg-[#4a2c1f] text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-[#341d13] transition">Lihat Semua Hewan</a>
    </section>

    {{-- Artikel Edukasi --}}
    <section class="container mx-auto py-16 text-center">
        <h2 class="text-4xl font-bold text-[#4a2c1f]">Artikel Edukasi</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
            @php
                $artikel = [
                    ["judul" => "Manfaat Adopsi Hewan", "gambar" => "img/ed1.jpg", "link" => "artikel1.php"],
                    ["judul" => "Persiapan Sebelum Adopsi", "gambar" => "img/ed2.jpg", "link" => "artikel2.php"],
                    ["judul" => "Merawat Hewan dengan Baik", "gambar" => "img/ed3.jpg", "link" => "artikel3.php"],
                    ["judul" => "Tips Adopsi yang Sukses", "gambar" => "img/ed4.jpg", "link" => "artikel4.php"],
                ];
            @endphp
            @foreach ($artikel as $a)
                <div class="bg-white p-4 border-2 border-[#8b5e34] rounded-lg shadow-md">
                    <img src="{{ asset($a['gambar']) }}" alt="{{ $a['judul'] }}" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-xl font-bold text-[#8b5e34] mt-3">{{ $a['judul'] }}</h3>
                    <a href="{{ $a['link'] }}" class="mt-3 inline-block bg-[#d9a36a] text-white px-4 py-2 rounded-lg hover:bg-[#c48950]">Baca Selengkapnya</a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Galeri --}}
    <section class="container mx-auto mt-12 px-6">
        <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Galeri Adopsi Berhasil</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @forelse($hewansDiadopsi as $hewan)
                <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
                    <img src="{{ asset('storage/gambar_hewan/' . $hewan->gambar) }}" alt="Adopsi Berhasil: {{ $hewan->nama }}" class="object-cover w-full h-full">
                </div>
            @empty
                <p class="text-gray-500">Belum ada galeri adopsi berhasil.</p>
            @endforelse
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-[#4a2c1f] text-white py-6 text-center mt-12">
        <p>&copy; 2025 AdoptMe | Semua Hak Cipta Dilindungi</p>
    </footer>

    {{-- WhatsApp Button --}}
    <a href="https://wa.me/{{ urlencode('62812118001') }}" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
        Chat via WhatsApp
    </a>

    {{-- Modal Login --}}
    <div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#8b5e34]">Login Diperlukan</h3>
                <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <p class="mb-6">Anda harus login terlebih dahulu untuk mengadopsi hewan.</p>
            <div class="flex justify-end space-x-4">
                <button onclick="hideLoginModal()" class="px-4 py-2 border border-[#8b5e34] text-[#8b5e34] rounded hover:bg-gray-100">Nanti</button>
                <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="px-4 py-2 bg-[#8b5e34] text-white rounded hover:bg-[#6b3f21]">Login Sekarang</a>
            </div>
        </div>
    </div>

    {{-- Script Modal --}}
    <script>
        function showLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.getElementById('loginModal').classList.add('flex');
        }
        function hideLoginModal() {
            document.getElementById('loginModal').classList.remove('flex');
            document.getElementById('loginModal').classList.add('hidden');
        }
    </script>