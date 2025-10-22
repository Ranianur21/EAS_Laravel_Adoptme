<x-app-layout>
    <div class="container mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center text-[#8b5e34] mb-6">
            Daftarkan Hewan untuk Diadopsi
        </h1>

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="max-w-xl mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tampilkan pesan sukses --}}
        @if (Session::has('success'))
            <div class="max-w-xl mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ Session::get('success') }}
            </div>
        @endif

        {{-- Tampilkan pesan error sistem --}}
        @if (Session::has('error'))
            <div class="max-w-xl mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('daftarkanhewan.store') }}" method="POST" enctype="multipart/form-data" 
            class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Hewan</label>
                <input type="text" name="nama" id="nama" 
                    value="{{ old('nama') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label for="jenis" class="block text-gray-700 font-semibold mb-2">Jenis Hewan</label>
                <select name="jenis" id="jenis" 
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Kucing" {{ old('jenis') == 'Kucing' ? 'selected' : '' }}>Kucing</option>
                    <option value="Anjing" {{ old('jenis') == 'Anjing' ? 'selected' : '' }}>Anjing</option>
                    <option value="Kelinci" {{ old('jenis') == 'Kelinci' ? 'selected' : '' }}>Kelinci</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" 
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="usia" class="block text-gray-700 font-semibold mb-2">Usia (dalam tahun)</label>
                <input type="number" name="usia" id="usia"
                    value="{{ old('usia') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="gambar" class="block text-gray-700 font-semibold mb-2">Foto Hewan</label>
                <input type="file" name="gambar" id="gambar" 
                    class="w-full border border-gray-300 rounded px-4 py-2" accept="image/*" required>
                <p class="text-sm text-gray-500 mt-1">Format yang diperbolehkan: jpg, jpeg, png, gif (maks 2MB)</p>
            </div>

            <button type="submit" 
                class="w-full bg-[#8b5e34] text-white font-bold py-3 px-6 rounded hover:bg-[#6b3f21] transition duration-300">
                Kirim Pengajuan Adopsi
            </button>
        </form>
    </div>

    {{-- SweetAlert2 (opsional untuk popup sukses) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(Session::get('success')),
                    confirmButtonColor: '#A0522D',
                    background: '#fef8f4',
                    color: '#5c3b19'
                });
            @endif
        });
    </script>
</x-app-layout>
