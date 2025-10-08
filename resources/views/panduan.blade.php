<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panduan Adopsi Hewan | AdoptMe</title>
    <!-- Tailwind CSS compiled by Vite -->
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-800 bg-white selection:bg-[#d9a36a]/60 selection:text-[#4a2c1f]">
    <!-- ===== Navbar (Blade component) ===== -->
    <x-navbar />

    <!-- ===== Hero / Header ===== -->
    <header class="relative isolate overflow-hidden bg-gradient-to-br from-[#FFF3E6] via-[#FDEBD0] to-[#FAD7A0] py-16 md:py-24">
        <!-- subtle pattern overlay -->
        <div class="pointer-events-none absolute inset-0 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/paw.png')] opacity-10 mix-blend-multiply"></div>

        <div class="relative z-10 mx-auto max-w-3xl px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#4a2c1f] drop-shadow-sm">Panduan Adopsi Hewan</h1>
            <p class="mt-4 text-lg md:text-xl text-[#5F4638]">Langkah penting agar proses adopsi berjalan <span class="font-semibold text-[#d9a36a]">aman</span>, <span class="font-semibold text-[#d9a36a]">nyaman</span>, dan <span class="font-semibold text-[#d9a36a]">bertanggung jawab</span></p>
            <a href="#langkah" class="inline-flex items-center gap-2 mt-8 px-6 py-3 bg-[#8b5e34] hover:bg-[#6d4828] text-white rounded-full shadow transition-colors duration-300">
                Jelajahi Panduan
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </div>
    </header>

    <!-- ===== Steps Section ===== -->
    <section id="langkah" class="relative py-16 md:py-20">
        <!-- decorative paw prints -->
        <svg class="pointer-events-none absolute left-0 top-12 w-32 md:w-48 opacity-10 text-[#d9a36a]" viewBox="0 0 64 64" fill="currentColor">
            <circle cx="20" cy="20" r="8" />
            <circle cx="44" cy="20" r="8" />
            <circle cx="20" cy="44" r="8" />
            <circle cx="44" cy="44" r="8" />
        </svg>

        <div class="container mx-auto px-6">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 max-w-6xl mx-auto">
                <!-- START: Loop each step card -->
                @php
                    $steps = [
                        [
                            'num' => '01',
                            'title' => 'Registrasi Akun',
                            'desc' => 'Masuk ke website/app AdoptMe, klik tombol “Daftar”, isi email & password lalu konfirmasi, dan verifikasi email jika diminta.'
                        ],
                        [
                            'num' => '02',
                            'title' => 'Lengkapi Profil',
                            'desc' => 'Setelah login, lengkapi data diri Anda: nama lengkap, nomor HP aktif, alamat lengkap, pengalaman memelihara (opsional), dan pilih role sebagai Calon Adopter.'
                        ],
                        [
                            'num' => '03',
                            'title' => 'Pilih Hewan yang Diinginkan',
                            'desc' => 'Telusuri katalog hewan yang tersedia, baca informasi lengkap: usia, jenis, kondisi, vaksinasi, dll. Jika tertarik, klik “Ajukan Adopsi”.'
                        ],
                        [
                            'num' => '04',
                            'title' => 'Ajukan Permohonan Adopsi',
                            'desc' => 'Isi form pengajuan: alasan ingin mengadopsi, kondisi rumah/tempat tinggal, komitmen perawatan jangka panjang. Kirim permohonan dan tunggu persetujuan dari tim AdoptMe.'
                        ],
                        [
                            'num' => '05',
                            'title' => 'Menunggu Verifikasi & Persetujuan',
                            'desc' => 'Admin akan meninjau form Anda. Jika disetujui, Anda akan mendapatkan notifikasi. Proses ini bisa memakan waktu 1–3 hari kerja.'
                        ],
                        [
                            'num' => '06',
                            'title' => 'Penyerahan Hewan',
                            'desc' => 'Anda akan dihubungi untuk jadwal penyerahan hewan. Hewan bisa diantar ke rumah Anda atau diambil di lokasi yang disepakati.'
                        ],
                        [
                            'num' => '07',
                            'title' => 'Konfirmasi Penerimaan',
                            'desc' => 'Unggah foto/video sebagai bukti penerimaan lalu klik “Konfirmasi Penerimaan” agar sistem mencatat bahwa proses adopsi selesai.'
                        ],
                        [
                            'num' => '08',
                            'title' => 'Rawat & Cintai Hewanmu',
                            'desc' => 'Hewan peliharaan bukan sekadar barang. Berikan tempat tinggal aman, makanan bergizi, dan waktu bermain cukup. Hubungi tim AdoptMe jika butuh bantuan.'
                        ],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <div class="group relative overflow-hidden rounded-xl shadow hover:shadow-lg transition-shadow border border-[#E4D7C6] bg-white flex flex-col p-6">
                        <!-- floating gradient ring -->
                        <div class="absolute -z-10 inset-0 opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-br from-[#fad7a0] via-[#f5c087] to-[#d9a36a]"></div>

                        <span class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-full bg-[#d9a36a]/20 text-[#8b5e34] text-lg font-bold ring-2 ring-[#d9a36a] ring-offset-2 ring-offset-white">
                            {{ $step['num'] }}
                        </span>
                        <h3 class="text-lg font-semibold text-[#4a2c1f]">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#5F4638] flex-1">{{ $step['desc'] }}</p>
                    </div>
                @endforeach

                <!-- Tips card spans all columns on large screens -->
                <div class="lg:col-span-3 sm:col-span-2 col-span-1 bg-[#4a2c1f] text-white rounded-xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <span class="inline-block animate-pulse">✨</span> Tips Tambahan
                    </h3>
                    <ul class="space-y-2 text-sm leading-relaxed list-disc list-inside">
                        <li>Pastikan seluruh anggota keluarga setuju sebelum mengadopsi.</li>
                        <li>Pikirkan komitmen jangka panjang, bukan hanya karena hewan lucu.</li>
                        <li>Anda boleh mengadopsi lebih dari satu hewan jika sanggup merawat semuanya.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer class="bg-[#4a2c1f] text-white py-6 text-center">
        <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
        <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
    </footer>

</body>
</html>
