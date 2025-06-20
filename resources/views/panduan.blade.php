<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @vite('resources/css/app.css')
    <title>AdoptMe - Tentang</title>
</head>

<x-navbar> </x-navbar>

<body class="bg-white text-gray-900">
<!-- Tentang Section -->
<section class="py-16">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-6">
        <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-lg text-center md:text-left">
            <h2 class="text-[#8b5e34] font-semibold text-lg">Tentang Kami</h2>
            <h3 class="text-3xl font-bold mt-2">Kenapa AdoptMe?</h3>
            <p class="text-[#6d4c41] mt-4" style="text-align: justify;">
                AdoptMe hadir untuk menjembatani calon pemilik hewan dengan sahabat AdoptMe yang membutuhkan rumah. Kami percaya bahwa setiap hewan berhak mendapatkan kasih sayang dan tempat tinggal yang layak.
            </p>
            <p class="text-[#6d4c41] mt-2" style="text-align: justify;">
                Melalui platform ini, kami mempermudah proses adopsi hewan dengan transparansi dan kemudahan akses informasi.
            </p>
            <a href="{{ route('kontak') }}" class="mt-6 inline-block bg-[#8b5e34] text-white py-2 px-6 rounded-lg hover:bg-[#6d4c41] transition duration-300">
                Hubungi Kami
            </a>
        </div>
        <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center">
            <img src="images/1.jpg" alt="Adopsi Hewan" class="rounded-lg shadow-lg">
        </div>
    </div>
</section>

<!-- FAQ section -->
<section id="faq" class="py-16 bg-white">
    <div class="container mx-auto text-center px-6">
        <h2 class="text-[#8b5e34] font-semibold text-lg">FAQ</h2>
        <h3 class="text-3xl font-bold mt-2">Pertanyaan yang Sering Diajukan</h3>
        <div class="mt-6 text-left max-w-3xl mx-auto space-y-4">
            <div class="p-4 border border-[#8b5e34] rounded-lg">
                <h4 class="font-bold text-[#4a2c1f]">Bagaimana cara mengadopsi hewan?</h4>
                <p class="text-[#6d4c41] mt-2">Anda bisa melihat daftar hewan yang tersedia di halaman "Hewan", lalu mengisi formulir adopsi atau menghubungi kami untuk informasi lebih lanjut.</p>
            </div>
            <div class="p-4 border border-[#8b5e34] rounded-lg">
                <h4 class="font-bold text-[#4a2c1f]">Apakah ada biaya adopsi?</h4>
                <p class="text-[#6d4c41] mt-2">Beberapa hewan mungkin memiliki biaya adopsi untuk menutupi perawatan dan vaksinasi. Detail lebih lanjut dapat ditemukan di halaman "Hewan".</p>
            </div>
            <div class="p-4 border border-[#8b5e34] rounded-lg">
                <h4 class="font-bold text-[#4a2c1f]">Bagaimana jika saya ingin menyerahkan hewan untuk diadopsi?</h4>
                <p class="text-[#6d4c41] mt-2">Silakan hubungi kami melalui halaman "Kontak" untuk mendapatkan panduan mengenai penyerahan hewan untuk diadopsi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

<!-- JavaScript untuk Dropdown -->
<script>
    const menuBtn = document.getElementById("menuDropdownBtn");
    const menuDropdown = document.getElementById("menuDropdown");

    menuBtn.addEventListener("click", () => {
        menuDropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
            menuDropdown.classList.add("hidden");
        }
    });
</script>

</body>
</html>