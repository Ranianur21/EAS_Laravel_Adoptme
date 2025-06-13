<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>AdoptMe - Kontak</title>
</head>

<x-navbar> </x-navbar>

<body class="bg-white text-gray-900">
<!-- Hubungi Kami Section -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-xl mx-auto">
            <h2 class="text-[#8b5e34] text-center font-semibold text-lg">Hubungi Kami</h2>
            <h3 class="text-3xl font-bold text-center mt-2">Kami Siap Membantu!</h3>
            <p class="text-[#6d4c41] text-center mt-4">Jika Anda memiliki pertanyaan atau ingin mengadopsi hewan, jangan ragu untuk menghubungi kami.</p>
        </div>

        <form class="mt-12 max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
            <h4 class="text-2xl font-bold text-[#8b5e34] text-center">Kirim Pesan</h4>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Nama</label>
                <input type="text" class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            </div>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Email</label>
                <input type="email" class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            </div>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Pesan</label>
                <textarea class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]" rows="4"></textarea>
            </div>
            <button type="submit" class="mt-6 w-full bg-[#8b5e34] text-white py-2 rounded-lg hover:bg-[#6d4c41] transition duration-300">Kirim Pesan</button>
        </form>

        <!-- Info Kontak -->
        <div class="mt-12 flex flex-col md:flex-row justify-center gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Alamat</h4>
                <p class="text-gray-600 mt-2">Jl. Mawar No. 49, Surabaya</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Email</h4>
                <p class="text-gray-600 mt-2">kontak@adoptme.com</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Telepon</h4>
                <p class="text-gray-600 mt-2">+62 812-3456-7890</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

</body>
</html>
