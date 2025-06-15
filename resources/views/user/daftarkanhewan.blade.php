{{-- resources/views/daftarkanhewan.blade.php --}}

{{-- Gunakan x-app-layout untuk halaman yang membutuhkan layout autentikasi --}}
{{-- Anda bisa menambahkan @auth dan @else jika ingin guest-layout untuk non-login,
     tapi untuk daftarkan hewan, biasanya hanya user login yang bisa --}}
<x-app-layout>
    {{-- Anda bisa menambahkan slot header jika ingin, contoh:
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftarkan Hewan') }}
        </h2>
    </x-slot>
    --}}

    <div class="container mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center text-[#8b5e34] mb-6">Daftarkan Hewan untuk Diadopsi</h1>

        <form action="{{ route('daftarkanhewan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Hewan</label>
                <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label for="jenis" class="block text-gray-700 font-semibold mb-2">Jenis Hewan</label>
                <select name="jenis" id="jenis" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Kucing">Kucing</option>
                    <option value="Anjing">Anjing</option>
                    <option value="Kelinci">Kelinci</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="usia" class="block text-gray-700 font-semibold mb-2">Usia (dalam tahun)</label>
                <input type="number" name="usia" id="usia" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border border-gray-300 rounded px-4 py-2" required></textarea>
            </div>

            <div class="mb-6">
                <label for="gambar" class="block text-gray-700 font-semibold mb-2">Foto Hewan</label>
                <input type="file" name="gambar" id="gambar" class="w-full border border-gray-300 rounded px-4 py-2" accept="image/*" required>
            </div>

            <button type="submit" class="w-full bg-[#8b5e34] text-white font-bold py-3 px-6 rounded hover:bg-[#6b3f21] transition duration-300">
                Kirim Pengajuan Adopsi
            </button>
        </form>
    </div>
</x-app-layout>