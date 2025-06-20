<!-- resources/views/user/profil/edit_profil.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-[#4a2c1f] mb-4">{{ __('Edit Profil') }}</h3>

                    <!-- Form untuk mengedit profil -->
                    <form method="POST" action="{{ route('update_profil') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="name" class="text-sm font-semibold text-gray-600">Nama Lengkap:</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- Email -->
                            <div>
                                <label for="email" class="text-sm font-semibold text-gray-600">Email:</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- Alamat -->
                            <div>
                                <label for="alamat" class="text-sm font-semibold text-gray-600">Alamat:</label>
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- Umur -->
                            <div>
                                <label for="umur" class="text-sm font-semibold text-gray-600">Umur:</label>
                                <input type="number" name="umur" id="umur" value="{{ old('umur', $user->umur) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- Pekerjaan -->
                            <div>
                                <label for="pekerjaan" class="text-sm font-semibold text-gray-600">Pekerjaan:</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- No Telepon -->
                            <div>
                                <label for="no_telp" class="text-sm font-semibold text-gray-600">Nomor Telepon:</label>
                                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>
                            <!-- Foto KTP -->
                            <div>
                                <label for="path_foto_ktp" class="text-sm font-semibold text-gray-600">Foto KTP:</label>
                                <div class="mt-2">
                                    <!-- Menampilkan nama file yang sudah ada -->
                                    @if($user->path_foto_ktp)
                                        <input type="file" name="path_foto_ktp" id="path_foto_ktp" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" onchange="updateFileName(this)">
                                        <p class="mt-2 text-sm text-gray-600">File yang diunggah: <strong>{{ basename($user->path_foto_ktp) }}</strong></p>
                                        <p class="text-sm text-gray-500">Ubah foto KTP jika diperlukan</p>
                                    @else
                                        <input type="file" name="path_foto_ktp" id="path_foto_ktp" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tombol submit -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-[#8b5e34] hover:bg-[#71492a] text-white font-bold py-2 px-4 rounded transition duration-300">
                                Perbarui Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Fungsi untuk memperbarui nama file yang dipilih pada input file
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : '';
        const fileLabel = document.querySelector('label[for="path_foto_ktp"]');
        fileLabel.innerHTML = fileName ? 'File yang dipilih: ' + fileName : 'Foto KTP:';
    }
</script>
