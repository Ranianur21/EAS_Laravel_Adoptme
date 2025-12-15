@auth
    <x-app-layout>
        {{-- Konten halaman hewan dimulai dari sini --}}
        <header class="bg-white shadow-md py-10 text-[#8b5e34] text-center">
            <h1 class="text-4xl font-bold">Temukan Sahabat Barumu</h1>
            <p class="mt-2 text-lg">Berikan mereka rumah yang penuh kasih 💕</p>
        </header>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <section class="container mx-auto mt-12 text-center px-6">
            <h2 class="text-2xl font-semibold text-[#4a2c1f]">Filter Hewan</h2>
            <div class="flex justify-center gap-4 mt-4">
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Semua">Semua</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Anjing">Anjing</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kucing">Kucing</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kelinci">Kelinci</button>
            </div>
        </section>

        <section class="container mx-auto py-12 text-center px-6">
            <h2 class="text-4xl font-bold text-[#4a2c1f] mb-6">Hewan yang Tersedia untuk Adopsi</h2>
            <div class="grid md:grid-cols-3 gap-6" id="hewan-list">
                @forelse($hewansTersedia as $hewan)
                    <div class="hewan-item bg-white p-6 border border-[#8b5e34] rounded-lg shadow-md flex flex-col justify-between h-full transition-transform duration-300 hover:scale-105" data-jenis="{{ $hewan->jenis }}">
                        <div class="w-full h-56 flex items-center justify-center bg-white">
                            <!-- PERBAIKAN PATH: images/gambar_hewan/ → assets/images/gambar_hewan/ -->
                            <img loading="lazy" src="{{ asset('assets/images/gambar_hewan/' . $hewan->gambar) }}" alt="Foto {{ $hewan->nama }}" class="w-full h-full object-contain rounded-md">
                        </div>
                        <h3 class="text-xl font-bold text-[#8b5e34] mt-3">{{ $hewan->nama }}</h3>
                        <p class="mt-2 text-gray-600 text-sm">{{ $hewan->jenis_kelamin }}, {{ $hewan->usia }} tahun</p>
                        <p class="mt-2 text-gray-700 text-sm">{!! nl2br(e($hewan->deskripsi)) !!}</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            @auth
                                <a href="{{ route('adopsi.form', ['hewan_id' => $hewan->id]) }}"
                                    class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21] transition duration-300">
                                    Adopsi
                                </a>
                            @else
                                <button onclick="showLoginModal()"
                                        class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21] transition duration-300">
                                        Adopsi
                                </button>
                            @endauth
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500">Belum ada hewan yang tersedia untuk adopsi saat ini.</p>
                @endforelse
            </div>
        </section>

        <div class="bg-[#8b5e34] shadow-md py-10 text-white p-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-center gap-8">
                <div class="md:w-1/2 text-center md:text-left px-4">
                    <h1 class="text-4xl font-bold">Mau daftarkan hewanmu untuk diadopsi?</h1>
                    <p class="mt-4 mb-6">
                        Bantu hewan kesayanganmu menemukan keluarga baru yang penuh cinta! Yuk, bantu mereka mendapatkan keluarga impian!
                    </p>
                    <a href="{{ route('daftarkanhewan.form') }}"
                    class="bg-white text-[#8b5e34] font-bold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                        Ayo daftarkan!
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-sm h-72 overflow-hidden rounded-lg shadow-lg">
                        <!-- PERBAIKAN PATH: images/adopsi.jpg → assets/images/adopsi.jpg -->
                        <img src="{{ asset('assets/images/adopsi.jpg') }}" alt="Hewan Adopsi" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <section class="container mx-auto mt-8 px-6">
            <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Testimoni Pengadopsi</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Saya selalu ingin memiliki kucing, tetapi ragu karena takut tidak bisa merawatnya dengan baik. Setelah mengadopsi Momo melalui AdoptMe, saya menyadari betapa menyenangkannya memiliki teman berbulu di rumah."</p>
                <p class="text-right text-sm font-semibold">- Naya, Pengadopsi Kucing Persia</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Mengadopsi kelinci adalah keputusan terbaik yang pernah saya buat! Bubu sangat menggemaskan dan cepat beradaptasi di rumah."</p>
                <p class="text-right text-sm font-semibold">- Balqis, Pengadopsi Kelinci Holland Lop</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Saya mengadopsi Max, seekor anjing golden retriever, melalui AdoptMe satu tahun lalu. Awalnya dia pemalu dan takut dengan lingkungan baru, tetapi sekarang ceria dan setia."</p>
                <p class="text-right text-sm font-semibold">- Rania, Pengadopsi Anjing Golden Retriever</p>
            </div>
        </section>

        <section class="container mx-auto mt-12 px-6">
            <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Galeri Adopsi Berhasil</h2>
            <div class="flex flex-wrap justify-center gap-6">
                @forelse($hewansDiadopsi as $hewan)
                    <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
                        <!-- PERBAIKAN PATH: assets/gambar_hewan/ → assets/images/gambar_hewan/ -->
                        <img src="{{ asset('assets/images/gambar_hewan/' . $hewan->gambar) }}" alt="Adopsi Berhasil: {{ $hewan->nama }}" class="object-cover w-full h-full">
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada hewan yang ditampilkan di galeri adopsi berhasil.</p>
                @endforelse
            </div>
        </section>

        <footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

        <a href="https://wa.me/{{ urlencode('62812118001') }}" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
            Chat via WhatsApp
        </a>

        {{-- Login Modal --}}
        <div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg w-96">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-[#8b5e34]">Login Diperlukan</h3>
                    <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <p class="mb-6">Anda harus login terlebih dahulu untuk mengadopsi hewan.</p>
                <div class="flex justify-end space-x-4">
                    <button onclick="hideLoginModal()" class="px-4 py-2 border border-[#8b5e34] text-[#8b5e34] rounded hover:bg-gray-100 transition duration-300">Nanti</button>
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="px-4 py-2 bg-[#8b5e34] text-white rounded hover:bg-[#6b3f21] transition duration-300">Login Sekarang</a>
                </div>
            </div>
        </div>

        <script>
            // Filter hewan
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const hewanItems = document.querySelectorAll('.hewan-item');

                function applyFilter(filter) {
                    hewanItems.forEach(item => {
                        if (filter === 'Semua' || item.dataset.jenis === filter) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }

                applyFilter('Semua');
                document.querySelector('.filter-btn[data-filter="Semua"]').classList.add('active-filter');

                filterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const filter = button.dataset.filter;
                        filterButtons.forEach(btn => {
                            btn.classList.remove('active-filter');
                        });
                        button.classList.add('active-filter');
                        applyFilter(filter);
                    });
                });
            });

            // Fungsi untuk modal login
            function showLoginModal() {
                document.getElementById('loginModal').classList.remove('hidden');
                document.getElementById('loginModal').classList.add('flex');
            }

            function hideLoginModal() {
                document.getElementById('loginModal').classList.remove('flex');
                document.getElementById('loginModal').classList.add('hidden');
            }
        </script>
        {{-- Konten halaman hewan berakhir di sini --}}
    </x-app-layout>
@else
    <x-guest-layout>
        {{-- Konten halaman hewan dimulai dari sini --}}
        <header class="bg-white shadow-md py-10 text-[#8b5e34] text-center">
            <h1 class="text-4xl font-bold">Temukan Sahabat Barumu</h1>
            <p class="mt-2 text-lg">Berikan mereka rumah yang penuh kasih 💕</p>
        </header>

        <section class="container mx-auto mt-12 text-center px-6">
            <h2 class="text-2xl font-semibold text-[#4a2c1f]">Filter Hewan</h2>
            <div class="flex justify-center gap-4 mt-4">
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Semua">Semua</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Anjing">Anjing</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kucing">Kucing</button>
                <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kelinci">Kelinci</button>
            </div>
        </section>

        <section class="container mx-auto py-12 text-center px-6">
            <h2 class="text-4xl font-bold text-[#4a2c1f] mb-6">Hewan yang Tersedia untuk Adopsi</h2>
            <div class="grid md:grid-cols-3 gap-6" id="hewan-list">
                @forelse($hewansTersedia as $hewan)
                    <div class="hewan-item bg-white p-6 border border-[#8b5e34] rounded-lg shadow-md flex flex-col justify-between h-full transition-transform duration-300 hover:scale-105" data-jenis="{{ $hewan->jenis }}">
                        <div class="w-full h-56 flex items-center justify-center bg-white">
                            <!-- PERBAIKAN PATH: assets/gambar_hewan/ → assets/images/gambar_hewan/ -->
                            <img loading="lazy" src="{{ asset('assets/images/gambar_hewan/' . $hewan->gambar) }}" alt="Foto {{ $hewan->nama }}" class="w-full h-full object-contain rounded-md">
                        </div>
                        <h3 class="text-xl font-bold text-[#8b5e34] mt-3">{{ $hewan->nama }}</h3>
                        <p class="mt-2 text-gray-600 text-sm">{{ $hewan->jenis_kelamin }}, {{ $hewan->usia }} tahun</p>
                        <p class="mt-2 text-gray-700 text-sm">{!! nl2br(e($hewan->deskripsi)) !!}</p>
                        <div class="flex justify-center space-x-4 mt-4">
                            @auth
                                <a href="{{ route('adopsi.form', ['hewan_id' => $hewan->id]) }}"
                                    class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21] transition duration-300">
                                    Adopsi
                                </a>
                            @else
                                <button onclick="showLoginModal()"
                                        class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21] transition duration-300">
                                        Adopsi
                                </button>
                            @endauth
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500">Belum ada hewan yang tersedia untuk adopsi saat ini.</p>
                @endforelse
            </div>
        </section>

        <div class="bg-[#8b5e34] shadow-md py-10 text-white p-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-center gap-8">
                <div class="md:w-1/2 text-center md:text-left px-4">
                    <h1 class="text-4xl font-bold">Mau daftarkan hewanmu untuk diadopsi?</h1>
                    <p class="mt-4 mb-6">
                    Yuk bantu hewan kesayanganmu menemukan rumah baru yang penuh kasih. Dengan mendaftarkan hewanmu di platform kami, kamu bisa menjangkau calon adopter yang bertanggung jawab dan peduli terhadap kesejahteraan hewan. Prosesnya mudah, aman, dan transparan.
                    </p>
                    @auth
                        <a href="{{ route('daftarkanhewan.form') }}"
                        class="bg-white text-[#8b5e34] font-bold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                            Ayo daftarkan!
                        </a>
                    @else
                        <button onclick="showLoginModal()"
                            class="bg-white text-[#8b5e34] font-bold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                            Ayo daftarkan!
                        </button>
                    @endauth
                </div>
                <div class="mt-8 md:mt-0 md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-sm h-72 overflow-hidden rounded-lg shadow-lg">
                        <!-- PERBAIKAN PATH: images/adopsi.jpg → assets/images/adopsi.jpg -->
                        <img src="{{ asset('assets/images/adopsi.jpg') }}" alt="Hewan Adopsi" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <section class="container mx-auto mt-8 px-6">
            <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Testimoni Pengadopsi</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Saya selalu ingin memiliki kucing, tetapi ragu karena takut tidak bisa merawatnya dengan baik. Setelah mengadopsi Momo melalui AdoptMe, saya menyadari betapa menyenangkannya memiliki teman berbulu di rumah."</p>
                <p class="text-right text-sm font-semibold">- Naya, Pengadopsi Kucing Persia</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Mengadopsi kelinci adalah keputusan terbaik yang pernah saya buat! Bubu sangat menggemaskan dan cepat beradaptasi di rumah."</p>
                <p class="text-right text-sm font-semibold">- Balqis, Pengadopsi Kelinci Holland Lop</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
                <p class="text-gray-600 italic">"Saya mengadopsi Max, seekor anjing golden retriever, melalui AdoptMe satu tahun lalu. Awalnya dia pemalu dan takut dengan lingkungan baru, tetapi sekarang ceria dan setia."</p>
                <p class="text-right text-sm font-semibold">- Rania, Pengadopsi Anjing Golden Retriever</p>
            </div>
        </section>

        <section class="container mx-auto mt-12 px-6">
            <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Galeri Adopsi Berhasil</h2>
            <div class="flex flex-wrap justify-center gap-6">
                @forelse($hewansDiadopsi as $hewan)
                    <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
                        <!-- PERBAIKAN PATH: assets/gambar_hewan/ → assets/images/gambar_hewan/ -->
                        <img src="{{ asset('assets/images/gambar_hewan/' . $hewan->gambar) }}" alt="Adopsi Berhasil: {{ $hewan->nama }}" class="object-cover w-full h-full">
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada hewan yang ditampilkan di galeri adopsi berhasil.</p>
                @endforelse
            </div>
        </section>

       <footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

        <a href="https://wa.me/{{ urlencode('62812118001') }}" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
            Chat via WhatsApp
        </a>

        {{-- Login Modal --}}
        <div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg w-96">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-[#8b5e34]">Login Diperlukan</h3>
                    <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <p class="mb-6">Anda harus login terlebih dahulu untuk mengadopsi hewan.</p>
                <div class="flex justify-end space-x-4">
                    <button onclick="hideLoginModal()" class="px-4 py-2 border border-[#8b5e34] text-[#8b5e34] rounded hover:bg-gray-100 transition duration-300">Nanti</button>
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="px-4 py-2 bg-[#8b5e34] text-white rounded hover:bg-[#6b3f21] transition duration-300">Login Sekarang</a>
                </div>
            </div>
        </div>

        <script>
            // Filter hewan
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const hewanItems = document.querySelectorAll('.hewan-item');

                function applyFilter(filter) {
                    hewanItems.forEach(item => {
                        if (filter === 'Semua' || item.dataset.jenis === filter) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }

                applyFilter('Semua');
                document.querySelector('.filter-btn[data-filter="Semua"]').classList.add('active-filter');

                filterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const filter = button.dataset.filter;
                        filterButtons.forEach(btn => {
                            btn.classList.remove('active-filter');
                        });
                        button.classList.add('active-filter');
                        applyFilter(filter);
                    });
                });
            });

            // Fungsi untuk modal login
            function showLoginModal() {
                document.getElementById('loginModal').classList.remove('hidden');
                document.getElementById('loginModal').classList.add('flex');
            }

            function hideLoginModal() {
                document.getElementById('loginModal').classList.remove('flex');
                document.getElementById('loginModal').classList.add('hidden');
            }
        </script>
        {{-- Konten halaman hewan berakhir di sini --}}
    </x-guest-layout>
@endauth