<x-app-layout>
    <div class="bg-[#f5efe6] min-h-screen py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Formulir Adopsi Hewan</h1>

            {{-- Step Indicator --}}
            <div class="flex justify-between items-center mb-8">
                @foreach ([1 => 'Detail Hewan', 2 => 'Data Diri', 3 => 'Unggah Dokumen', 4 => 'Review'] as $step => $label)
                    <div class="flex-1 text-center">
                        <div id="step-{{ $step }}-indicator" class="w-10 h-10 mx-auto flex items-center justify-center rounded-full border-2 border-[#8b5e34] text-[#8b5e34] font-bold">
                            {{ $step }}
                        </div>
                        <p class="text-sm mt-2 text-[#4a2c1f]">{{ $label }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Menampilkan pesan error dari session (misal dari controller jika validasi gagal secara keseluruhan) --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Formulir Utama --}}
            <form id="adopsiForm" action="{{ route('adopsi.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="hewan_id" value="{{ $hewan->id }}">

                {{-- Step 1: Informasi Hewan dan Alasan --}}
                <div class="step" id="step-1">
                    <h2 class="text-xl font-semibold text-[#4a2c1f] mb-4">Informasi Hewan yang Ingin Diadopsi</h2>
                    <div class="mb-4">
                        <label class="block text-[#4a2c1f] font-medium mb-1">Nama Hewan</label>
                        <input type="text" value="{{ $hewan->nama }}" class="w-full border rounded-md p-2 bg-gray-100" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[#4a2c1f] font-medium mb-1">Jenis</label>
                        <input type="text" value="{{ $hewan->jenis }}" class="w-full border rounded-md p-2 bg-gray-100" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="alasan" class="block text-[#4a2c1f] font-medium mb-1">Alasan Mengadopsi</label>
                        <textarea name="alasan" id="alasan" rows="4" class="w-full border rounded-md p-2 @error('alasan') border-red-500 @enderror" placeholder="Jelaskan alasan Anda mengadopsi hewan ini (minimal 20 karakter)." required>{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="nextStep(1)" class="bg-[#8b5e34] text-white px-4 py-2 rounded-md">Lanjut</button>
                    </div>
                </div>

                {{-- Step 2: Konfirmasi Data Diri --}}
                <div class="step hidden" id="step-2">
                    <h2 class="text-xl font-semibold text-[#4a2c1f] mb-4">Konfirmasi Data Diri Anda</h2>
                    <div class="mb-4 text-[#4a2c1f]">
                        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Nomor Telepon:</strong> {{ Auth::user()->no_telp ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ Auth::user()->alamat ?? '-' }}</p>
                        <p class="mt-4 text-sm text-gray-600">Pastikan data di atas sudah benar. Jika ada yang salah, silakan perbarui di halaman <a href="{{ route('profil') }}" class="text-blue-600 underline">Profil Anda</a>.</p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" onclick="prevStep()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Kembali</button>
                        <button type="button" onclick="nextStep(2)" class="bg-[#8b5e34] text-white px-4 py-2 rounded-md">Lanjut</button>
                    </div>
                </div>

                {{-- Step 3: Unggah Dokumen --}}
                <div class="step hidden" id="step-3">
                    <h2 class="text-xl font-semibold text-[#4a2c1f] mb-4">Unggah Dokumen</h2>

                    {{-- Unggah KTP --}}
                    <div class="mb-4">
                        <label for="ktp" class="block text-[#4a2c1f] font-medium mb-1">Unggah KTP Anda (PDF/JPG/JPEG/PNG, Max 2MB)</label>
                        @if(Auth::user()->path_foto_ktp)
                            <p class="text-sm text-gray-600 mb-2">Anda sudah mengunggah KTP di profil. Jika ada perubahan atau ingin mengunggah yang baru, silakan pilih file di bawah.</p>
                            <a href="{{ asset('storage/' . Auth::user()->path_foto_ktp) }}" target="_blank" class="text-blue-600 underline text-sm block mb-1">Lihat KTP yang sudah ada</a>
                            <input type="file" name="ktp" id="ktp" accept=".pdf,.jpg,.jpeg,.png" class="w-full border rounded-md p-2 @error('ktp') border-red-500 @enderror">
                            <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ada perubahan.</p>
                        @else
                            <input type="file" name="ktp" id="ktp" accept=".pdf,.jpg,.jpeg,.png" class="w-full border rounded-md p-2 @error('ktp') border-red-500 @enderror" required>
                            <p class="text-sm text-red-500 mt-1">*KTP belum tersedia di profil Anda. Wajib diunggah di sini.</p>
                        @endif
                        @error('ktp')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Unggah Surat Pernyataan --}}
                    <div class="mb-4">
                        <label for="surat_pernyataan" class="block text-[#4a2c1f] font-medium mb-1">Surat Pernyataan (PDF, Max 2MB)</label>
                        <a href="https://docs.google.com/document/d/1bAlPVG7OiGK-EZqzDroMUFq_NOlFZVOfq1XjoiFUD68/edit?usp=sharing"
                           target="_blank"
                           class="text-blue-600 underline text-sm block mb-1">Unduh template surat pernyataan di sini</a>
                        <input type="file" name="surat_pernyataan" id="surat_pernyataan" accept=".pdf" class="w-full border rounded-md p-2 @error('surat_pernyataan') border-red-500 @enderror" required>
                        @error('surat_pernyataan')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="prevStep()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Kembali</button>
                        <button type="button" onclick="nextStep(3)" class="bg-[#8b5e34] text-white px-4 py-2 rounded-md">Lanjut</button>
                    </div>
                </div>

                {{-- Step 4: Review dan Kirim --}}
                <div class="step hidden" id="step-4">
                    <h2 class="text-xl font-semibold text-[#4a2c1f] mb-4">Review dan Kirim</h2>
                    <p class="mb-4 text-[#4a2c1f]">Pastikan semua informasi yang Anda isi sudah benar sebelum mengirim.</p>

                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200 mb-6">
                        <h3 class="font-semibold text-[#4a2c1f] mb-2">Ringkasan Pengajuan:</h3>
                        <p class="mb-1"><strong>Hewan:</strong> <span id="review-hewan-nama"></span> (<span id="review-hewan-jenis"></span>)</p>
                        <p class="mb-1"><strong>Alasan Adopsi:</strong> <br><span id="review-alasan" class="italic text-gray-700"></span></p>
                        <p class="mb-1"><strong>Pengaju:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
                        <p class="mb-1"><strong>Nomor Telepon:</strong> {{ Auth::user()->no_telp ?? '-' }}</p>
                        <p class="mb-1"><strong>Alamat:</strong> {{ Auth::user()->alamat ?? '-' }}</p>
                        <p class="mb-1"><strong>Dokumen KTP:</strong> <span id="review-ktp-status"></span></p>
                        <p class="mb-1"><strong>Surat Pernyataan:</strong> <span id="review-surat-status"></span></p>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="prevStep()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Kembali</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Kirim Pengajuan Adopsi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Javascript untuk langkah-langkah form, validasi dan review
        let currentStep = 1;
        const totalSteps = 4;
        const steps = document.querySelectorAll('.step');
        const stepIndicators = document.querySelectorAll('[id^="step-"][id$="-indicator"]');
        const form = document.getElementById('adopsiForm');

        function showStep(step) {
            steps.forEach(s => s.classList.add('hidden'));
            stepIndicators.forEach(indicator => indicator.classList.remove('bg-[#8b5e34]', 'text-white'));

            document.getElementById(`step-${step}`).classList.remove('hidden');
            document.getElementById(`step-${step}-indicator`).classList.add('bg-[#8b5e34]', 'text-white');
        }

        function validateStep(step) {
            let isValid = true;
            let firstInvalidField = null;

            if (step === 1) {
                const alasanField = document.getElementById('alasan');
                if (!alasanField.value.trim() || alasanField.value.trim().length < 20) {
                    isValid = false;
                    if (!alasanField.value.trim()) {
                        alert('Alasan mengadopsi tidak boleh kosong.');
                    } else {
                        alert('Alasan mengadopsi minimal 20 karakter.');
                    }
                    firstInvalidField = alasanField;
                }
            } else if (step === 3) {
                const ktpField = document.getElementById('ktp');
                const suratPernyataanField = document.getElementById('surat_pernyataan');

                // Logika validasi KTP
                const userHasKtpInProfile = "{{ Auth::user()->path_foto_ktp ? 'true' : 'false' }}" === 'true';

                if (!userHasKtpInProfile && !ktpField.files.length) {
                    isValid = false;
                    alert('Anda belum mengunggah KTP di profil. Harap unggah KTP pada form ini.');
                    firstInvalidField = ktpField;
                }

                // Logika validasi Surat Pernyataan
                if (isValid && !suratPernyataanField.files.length) { // Pastikan isValid masih true sebelum cek ini
                    isValid = false;
                    alert('Surat Pernyataan wajib diunggah.');
                    firstInvalidField = suratPernyataanField;
                }
            }

            if (!isValid && firstInvalidField) {
                firstInvalidField.focus();
            }
            return isValid;
        }

        function updateReviewStep() {
            document.getElementById('review-hewan-nama').textContent = "{{ $hewan->nama }}";
            document.getElementById('review-hewan-jenis').textContent = "{{ $hewan->jenis }}";
            document.getElementById('review-alasan').textContent = document.getElementById('alasan').value;

            const userHasKtpInProfile = "{{ Auth::user()->path_foto_ktp ? 'true' : 'false' }}" === 'true';
            const ktpUploadedInForm = document.getElementById('ktp').files.length > 0;

            let ktpStatus = '';
            if (userHasKtpInProfile && !ktpUploadedInForm) {
                ktpStatus = 'Sudah ada di profil';
            } else if (ktpUploadedInForm) {
                ktpStatus = 'Diunggah baru';
            } else {
                ktpStatus = 'Belum ada'; // Seharusnya tidak terjadi jika validasi berfungsi
            }
            document.getElementById('review-ktp-status').textContent = ktpStatus;

            const suratUploaded = document.getElementById('surat_pernyataan').files.length > 0;
            document.getElementById('review-surat-status').textContent = suratUploaded ? 'Sudah diunggah' : 'Belum diunggah';
        }


        function nextStep(stepNumber) {
            if (validateStep(stepNumber)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    if (currentStep === totalSteps) { // Jika masuk ke step review
                        updateReviewStep();
                    }
                    showStep(currentStep);
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);

            // Tambahkan event listener untuk menangkap error validasi dari Laravel (jika ada)
            // Ini akan mengarahkan ke step yang benar jika validasi Laravel gagal
            @if ($errors->any())
                let firstErrorFieldStep = 1; // Default ke step 1
                @if ($errors->has('alasan'))
                    firstErrorFieldStep = 1;
                @elseif ($errors->has('ktp') || $errors->has('surat_pernyataan'))
                    firstErrorFieldStep = 3;
                @endif
                currentStep = firstErrorFieldStep;
                showStep(currentStep);
                // Scroll to the first error field if needed
                const firstErrorElement = document.querySelector('.border-red-500');
                if (firstErrorElement) {
                    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            @endif
        });
    </script>
</x-app-layout>