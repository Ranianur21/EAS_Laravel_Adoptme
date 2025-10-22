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

                    <!-- ✅ Pesan sukses atau error -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded-md">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form untuk mengedit profil -->
                    <form id="editProfilForm" method="POST" action="{{ route('update_profil') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="name" class="text-sm font-semibold text-gray-600">Nama Lengkap:</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="text-sm font-semibold text-gray-600">Email:</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="alamat" class="text-sm font-semibold text-gray-600">Alamat:</label>
                                <input type="text" name="alamat" id="alamat"
                                    value="{{ old('alamat', $user->alamat) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <!-- Umur -->
                            <div>
                                <label for="umur" class="text-sm font-semibold text-gray-600">Umur:</label>
                                <input type="number" name="umur" id="umur"
                                    value="{{ old('umur', $user->umur) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    min="1" max="100" required>
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <label for="pekerjaan" class="text-sm font-semibold text-gray-600">Pekerjaan:</label>
                                <input type="text" name="pekerjaan" id="pekerjaan"
                                    value="{{ old('pekerjaan', $user->pekerjaan) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>

                            <!-- No Telepon -->
                            <div>
                                <label for="no_telp" class="text-sm font-semibold text-gray-600">Nomor Telepon:</label>
                                <input type="text" name="no_telp" id="no_telp"
                                    value="{{ old('no_telp', $user->no_telp) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            </div>

                            <!-- Foto KTP -->
                            <div>
                                <label for="path_foto_ktp" class="text-sm font-semibold text-gray-600">Foto KTP:</label>
                                <div class="mt-2">
                                    @if($user->path_foto_ktp)
                                        <input type="file" name="path_foto_ktp" id="path_foto_ktp"
                                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                            onchange="updateFileName(this)" accept=".jpg,.jpeg,.png">
                                        <p id="uploadedFile" class="mt-2 text-sm text-gray-600">
                                            File yang diunggah: <strong>{{ basename($user->path_foto_ktp) }}</strong>
                                        </p>
                                        <p class="text-sm text-gray-500">Ubah atau hapus foto KTP jika diperlukan (JPG/PNG, maks. 2MB)</p>

                                        <!-- ✅ Tombol hapus foto -->
                                        <button type="button" onclick="clearKTP()"
                                            class="mt-2 bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                            Hapus Foto KTP
                                        </button>
                                    @else
                                        <input type="file" name="path_foto_ktp" id="path_foto_ktp"
                                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                            accept=".jpg,.jpeg,.png" required>
                                        <p class="text-sm text-gray-500">Wajib upload foto KTP (JPG/PNG, maks. 2MB)</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tombol submit -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-[#8b5e34] hover:bg-[#71492a] text-white font-bold py-2 px-4 rounded transition duration-300">
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
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : '';
        const fileLabel = document.querySelector('label[for="path_foto_ktp"]');
        fileLabel.innerHTML = fileName ? 'File yang dipilih: ' + fileName : 'Foto KTP:';
    }
    
    function clearKTP() {
        const fileInput = document.getElementById('path_foto_ktp');
        const uploadedText = document.getElementById('uploadedFile');

        // reset input
        fileInput.value = '';
        if (uploadedText) uploadedText.style.display = 'none';

        alert('Foto KTP berhasil dihapus. Silakan upload file baru jika diperlukan.');
    }

    document.getElementById('editProfilForm').addEventListener('submit', function (e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const umur = document.getElementById('umur').value;
        const fileInput = document.getElementById('path_foto_ktp');
        const file = fileInput.files[0];

        if (!name || !email || !alamat || !umur) {
            alert('Harap isi semua field wajib!');
            e.preventDefault();
            return;
        }

        if (isNaN(umur) || umur <= 0) {
            alert('Umur harus berupa angka positif!');
            e.preventDefault();
            return;
        }

        if (file) {
            const validExtensions = ['image/jpeg', 'image/png'];
            if (!validExtensions.includes(file.type)) {
                alert('Format file tidak valid! Hanya JPG/PNG yang diperbolehkan.');
                e.preventDefault();
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                e.preventDefault();
                return;
            }
        }
    });
</script>
