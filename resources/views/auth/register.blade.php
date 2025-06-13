<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AdoptMe</title>
    @vite('resources/css/app.css')
    <style>
        /* Gaya untuk step indicator */
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px; /* w-8 */
            height: 32px; /* h-8 */
            border-radius: 9999px; /* rounded-full */
            border: 2px solid #D1D5DB; /* border-gray-300 */
            color: #6B7280; /* text-gray-500 */
            font-weight: 600; /* font-semibold */
        }
        .step-indicator.active {
            border-color: #8b5e34; /* border-[#8b5e34] */
            color: #8b5e34; /* text-[#8b5e34] */
        }
        .step-indicator.completed {
            background-color: #8b5e34; /* bg-[#8b5e34] */
            border-color: #8b5e34; /* border-[#8b5e34] */
            color: white; /* text-white */
        }
        .step-indicator.completed svg {
            width: 16px; /* w-4 */
            height: 16px; /* h-4 */
        }
        .step-line {
            flex-grow: 1; /* flex-grow */
            height: 2px; /* h-0.5 */
            background-color: #D1D5DB; /* bg-gray-300 */
        }
        .step-line.active {
            background-color: #8b5e34; /* bg-[#8b5e34] */
        }

        /* Styling untuk file input kustom */
        .custom-file-input {
            width: 100%; /* w-full */
            padding: 12px 16px; /* px-4 py-3 */
            border: 1px solid #8b5e34; /* border border-[#8b5e34] */
            border-radius: 8px; /* rounded-lg */
            outline: none; /* focus:outline-none */
            box-shadow: none; /* focus:ring-2 focus:ring-[#8b5e34] akan ditangani oleh border */
        }
        .custom-file-input:focus {
            outline: 2px solid #8b5e34;
            outline-offset: 2px;
        }
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-input::before {
            content: 'Pilih File';
            display: inline-block;
            background-color: #d9a36a; /* bg-[#d9a36a] */
            color: white; /* text-white */
            padding: 8px 16px; /* py-2 px-4 */
            border-radius: 8px; /* rounded-lg */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-md */
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            outline: none;
            margin-right: 12px; /* space-x-3 */
        }
        .custom-file-input:hover::before {
            background-color: #c48950; /* hover:bg-[#c48950] */
        }
        .custom-file-input:active::before {
            background-color: #b07845; /* active:bg-[#b07845] */
        }
    </style>
</head>
<body class="bg-[#8b5e34] flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg text-center relative">
        {{-- Tombol kembali ke halaman utama (placeholder untuk preview) --}}
        <button onclick="alert('Kembali ke Halaman Utama')" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>

        <h2 class="text-3xl font-semibold text-gray-700 mb-6">Daftar <span class="text-[#8b5e34]">AdoptMe</span></h2>

        {{-- Indikator Langkah (Multi-step progress bar) --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex flex-col items-center flex-1">
                <div id="step-indicator-1" class="step-indicator active">1</div>
                <span class="text-xs mt-2 text-gray-600">Buat Akun</span>
            </div>
            <div id="line-1" class="step-line"></div>
            <div class="flex flex-col items-center flex-1">
                <div id="step-indicator-2" class="step-indicator">2</div>
                <span class="text-xs mt-2 text-gray-600">Lengkapi Profil</span>
            </div>
            <div id="line-2" class="step-line"></div>
            <div class="flex flex-col items-center flex-1">
                <div id="step-indicator-3" class="step-indicator">3</div>
                <span class="text-xs mt-2 text-gray-600">Verifikasi Identitas</span>
            </div>
        </div>

        {{-- Formulir Multi-step --}}
        <form id="registrationForm" method="POST" action="#" class="flex flex-col space-y-4" enctype="multipart/form-data">
            @csrf

            {{-- STEP 1: Email & Password --}}
            <div id="step-1" class="form-step">
                <input type="email" name="email" placeholder="Masukkan Email" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full"
                       value="">
                <p id="email-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="password" name="password" placeholder="Password (min 8 karakter)" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4">
                <p id="password-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4">
                <p id="password_confirmation-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <button type="button" onclick="nextStep(1)" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-full mt-6">Selanjutnya</button>
            </div>

            {{-- STEP 2: Data Diri --}}
            <div id="step-2" class="form-step hidden">
                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full"
                       value="">
                <p id="nama_lengkap-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="text" name="alamat" placeholder="Alamat Lengkap" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                       value="">
                <p id="alamat-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="number" name="umur" placeholder="Umur (Tulis dalam angka)" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                       value="">
                <p id="umur-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="text" name="pekerjaan" placeholder="Pekerjaan" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                       value="">
                <p id="pekerjaan-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <input type="tel" name="no_telp" placeholder="Nomor Telepon" required
                       class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                       value="">
                <p id="no_telp-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <div class="flex justify-between mt-6">
                    <button type="button" onclick="prevStep(2)" class="bg-gray-300 text-gray-800 py-3 rounded-lg text-lg font-semibold hover:bg-gray-400 transition w-5/12">Sebelumnya</button>
                    <button type="button" onclick="nextStep(2)" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-5/12">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 3: Upload Identitas --}}
            <div id="step-3" class="form-step hidden">
                <label for="upload_ktp" class="block text-gray-700 text-sm font-bold mb-2 text-left">Foto KTP:</label>
                <input type="file" name="upload_ktp" id="upload_ktp" accept="image/*" required
                       class="custom-file-input">
                <p id="upload_ktp-filename" class="text-sm text-gray-500 mt-2 text-left">Belum ada file yang dipilih</p>
                <p id="upload_ktp-error" class="text-red-500 text-xs mt-1 text-left hidden"></p>

                <div class="flex justify-between mt-6">
                    <button type="button" onclick="prevStep(3)" class="bg-gray-300 text-gray-800 py-3 rounded-lg text-lg font-semibold hover:bg-gray-400 transition w-5/12">Sebelumnya</button>
                    <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-5/12">Daftar</button>
                </div>
            </div>
        </form>

        <p class="text-sm text-gray-600 mt-4">Sudah punya akun? <a href="#" onclick="alert('Mengarahkan ke halaman Login')" class="text-[#8b5e34] font-semibold">Login di sini</a></p>
    </div>

    <script>
        let currentStep = 1;
        const formSteps = document.querySelectorAll('.form-step');
        const stepIndicators = [
            document.getElementById('step-indicator-1'),
            document.getElementById('step-indicator-2'),
            document.getElementById('step-indicator-3')
        ];
        const stepLines = [
            document.getElementById('line-1'),
            document.getElementById('line-2')
        ];
        const uploadKtpInput = document.getElementById('upload_ktp');
        const uploadKtpFilenameDisplay = document.getElementById('upload_ktp-filename');

        // Fungsi untuk menampilkan langkah tertentu
        function showStep(step) {
            formSteps.forEach((s, index) => {
                s.classList.add('hidden');
                if (index + 1 === step) {
                    s.classList.remove('hidden');
                }
            });

            // Update indikator langkah
            stepIndicators.forEach((indicator, index) => {
                if (index + 1 < step) {
                    indicator.classList.remove('active');
                    indicator.classList.add('completed');
                    indicator.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
                } else if (index + 1 === step) {
                    indicator.classList.remove('completed');
                    indicator.classList.add('active');
                    indicator.innerHTML = index + 1;
                } else {
                    indicator.classList.remove('active', 'completed');
                    indicator.innerHTML = index + 1;
                }
            });

            // Update garis indikator
            stepLines.forEach((line, index) => {
                if (index + 1 < step) {
                    line.classList.add('active');
                } else {
                    line.classList.remove('active');
                }
            });
        }

        // Validasi langkah
        function validateStep(step) {
            let isValid = true;
            const errors = {};
            const form = document.getElementById('registrationForm');

            // Sembunyikan semua pesan error sebelumnya
            document.querySelectorAll('p[id$="-error"]').forEach(p => p.classList.add('hidden'));

            if (step === 1) {
                const email = form.elements['email'].value;
                const password = form.elements['password'].value;
                const passwordConfirmation = form.elements['password_confirmation'].value;

                if (!email) {
                    errors.email = 'Email tidak boleh kosong.';
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    errors.email = 'Format email tidak valid.';
                    isValid = false;
                }
                
                if (!password) {
                    errors.password = 'Password tidak boleh kosong.';
                    isValid = false;
                } else if (password.length < 8) {
                    errors.password = 'Password minimal 8 karakter.';
                    isValid = false;
                }

                if (password !== passwordConfirmation) {
                    errors.password_confirmation = 'Konfirmasi password tidak cocok.';
                    isValid = false;
                }

                // Tampilkan error (jika ada)
                for (const field in errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errors[field];
                        errorElement.classList.remove('hidden');
                    }
                }

            } else if (step === 2) {
                const namaLengkap = form.elements['nama_lengkap'].value;
                const alamat = form.elements['alamat'].value;
                const umur = parseInt(form.elements['umur'].value);
                const pekerjaan = form.elements['pekerjaan'].value;
                const noTelp = form.elements['no_telp'].value;

                if (!namaLengkap) { errors.nama_lengkap = 'Nama lengkap tidak boleh kosong.'; isValid = false; }
                if (!alamat) { errors.alamat = 'Alamat tidak boleh kosong.'; isValid = false; }
                
                // Validasi umur
                if (isNaN(umur) || umur < 17) { 
                    errors.umur = 'Umur minimal 17 tahun'; 
                    isValid = false; 
                }

                if (!pekerjaan) { errors.pekerjaan = 'Pekerjaan tidak boleh kosong.'; isValid = false; }
                if (!noTelp) { errors.no_telp = 'Nomor telepon tidak boleh kosong.'; isValid = false; }
                else if (!/^\d+$/.test(noTelp)) { errors.no_telp = 'Nomor telepon hanya boleh berisi angka.'; isValid = false; }


                for (const field in errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errors[field];
                        errorElement.classList.remove('hidden');
                    }
                }
            } else if (step === 3) {
                const uploadKtp = form.elements['upload_ktp'].files.length > 0;
                if (!uploadKtp) {
                    errors.upload_ktp = 'Foto KTP wajib diunggah.';
                    isValid = false;
                } else {
                    const file = form.elements['upload_ktp'].files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!allowedTypes.includes(file.type)) {
                        errors.upload_ktp = 'Format file tidak didukung (JPEG, PNG, GIF).';
                        isValid = false;
                    }
                    if (file.size > maxSize) {
                        errors.upload_ktp = 'Ukuran file terlalu besar (maks 2MB).';
                        isValid = false;
                    }
                }

                for (const field in errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errors[field];
                        errorElement.classList.remove('hidden');
                    }
                }
            }
            return isValid;
        }

        // Fungsi untuk melangkah ke step berikutnya
        function nextStep(current) {
            if (validateStep(current)) {
                currentStep = current + 1;
                showStep(currentStep);
            }
        }

        // Fungsi untuk kembali ke step sebelumnya
        function prevStep(current) {
            currentStep = current - 1;
            showStep(currentStep);
        }

        // Inisialisasi: Tampilkan step pertama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
            // Sembunyikan error Laravel karena ini hanya preview statis
            const laravelErrors = document.getElementById('laravel-errors');
            if (laravelErrors) {
                laravelErrors.classList.add('hidden');
            }
        });

        // Update nama file KTP yang dipilih
        uploadKtpInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                uploadKtpFilenameDisplay.textContent = this.files[0].name;
                uploadKtpFilenameDisplay.classList.remove('hidden');
            } else {
                uploadKtpFilenameDisplay.textContent = 'Belum ada file yang dipilih';
            }
        });

    </script>
</body>
</html>