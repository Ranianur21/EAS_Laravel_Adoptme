<x-guest-layout>
    {{-- Parent container for the entire registration form to handle background and centering --}}
    {{-- This assumes guest-layout itself provides a minimal centered structure, but we'll add our own background. --}}
    <div class="bg-[#8b5e34] flex items-center justify-center min-h-screen p-4">

        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg text-center relative">
            {{-- Close/Back button to homepage --}}
            <button onclick="window.location.href='{{ url('/') }}'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800 focus:outline-none">&times;</button>

            <h2 class="text-3xl font-semibold text-gray-700 mb-6">Daftar <span class="text-[#8b5e34]">AdoptMe</span></h2>

            {{-- Step Indicator (Multi-step progress bar) --}}
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

            {{-- Display Laravel server-side errors --}}
            @if ($errors->any())
                <div id="laravel-server-errors" class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-left">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Multi-step Form --}}
            <form id="registrationForm" method="POST" action="{{ route('register') }}" class="flex flex-col space-y-4" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- STEP 1: Email & Password --}}
                <div id="step-1" class="form-step">
                    <input type="email" name="email" placeholder="Masukkan Email" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full"
                           value="{{ old('email') }}">
                    {{-- ID untuk pesan error JS validation --}}
                    <p id="email-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    {{-- x-input-error untuk pesan error Laravel (tetap ada untuk fallback) --}}
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-left" />

                    <input type="password" name="password" placeholder="Password (min 8 karakter)" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4">
                    <p id="password-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-left" />

                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4">
                    <p id="password_confirmation-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-left" />

                    <button type="button" onclick="nextStep(1)" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-full mt-6">Selanjutnya</button>
                </div>

                {{-- STEP 2: Personal Data --}}
                <div id="step-2" class="form-step hidden">
                    {{-- PENTING: Gunakan name="name" untuk konsistensi Breeze dan ubah kolom DB jika belum --}}
                    <input type="text" name="name" placeholder="Nama Lengkap" required
                         class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full"
                         value="{{ old('name') }}">
                    <p id="name-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-left" />

                    <input type="text" name="alamat" placeholder="Alamat Lengkap" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                           value="{{ old('alamat') }}">
                    <p id="alamat-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-left" />

                    <input type="number" name="umur" placeholder="Umur (Tulis dalam angka)" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                           value="{{ old('umur') }}">
                    <p id="umur-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('umur')" class="mt-2 text-left" />

                    <input type="text" name="pekerjaan" placeholder="Pekerjaan" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                           value="{{ old('pekerjaan') }}">
                    <p id="pekerjaan-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2 text-left" />

                    <input type="tel" name="no_telp" placeholder="Nomor Telepon" required
                           class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34] w-full mt-4"
                           value="{{ old('no_telp') }}">
                    <p id="no_telp-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('no_telp')" class="mt-2 text-left" />

                    <div class="flex justify-between mt-6">
                        <button type="button" onclick="prevStep(2)" class="bg-gray-300 text-gray-800 py-3 rounded-lg text-lg font-semibold hover:bg-gray-400 transition w-5/12">Sebelumnya</button>
                        <button type="button" onclick="nextStep(2)" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-5/12">Selanjutnya</button>
                    </div>
                </div>

                {{-- STEP 3: Identity Upload --}}
                <div id="step-3" class="form-step hidden">
                    <label for="upload_ktp" class="block text-gray-700 text-sm font-bold mb-2 text-left">Foto KTP:</label>
                    <input type="file" name="upload_ktp" id="upload_ktp" accept="image/*" required
                           class="custom-file-input">
                    <p id="upload_ktp-filename" class="text-sm text-gray-500 mt-2 text-left">Belum ada file yang dipilih</p>
                    <p id="upload_ktp-error" class="mt-2 text-left text-red-600 text-sm hidden"></p>
                    <x-input-error :messages="$errors->get('upload_ktp')" class="mt-2 text-left" />

                    <div class="flex justify-between mt-6">
                        <button type="button" onclick="prevStep(3)" class="bg-gray-300 text-gray-800 py-3 rounded-lg text-lg font-semibold hover:bg-gray-400 transition w-5/12">Sebelumnya</button>
                        <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition w-5/12">Daftar</button>
                    </div>
                </div>
            </form>

            <p class="text-sm text-gray-600 mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#8b5e34] font-semibold">Login di sini</a></p>
        </div>
    </div>

    {{-- Custom CSS for step indicator and file input (consider moving to app.css) --}}
    <style>
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 9999px;
            border: 2px solid #D1D5DB;
            color: #6B7280;
            font-weight: 600;
        }
        .step-indicator.active {
            border-color: #8b5e34;
            color: #8b5e34;
        }
        .step-indicator.completed {
            background-color: #8b5e34;
            border-color: #8b5e34;
            color: white;
        }
        .step-indicator.completed svg {
            width: 16px;
            height: 16px;
        }
        .step-line {
            flex-grow: 1;
            height: 2px;
            background-color: #D1D5DB;
        }
        .step-line.active {
            background-color: #8b5e34;
        }

        /* Styling for custom file input */
        .custom-file-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #8b5e34;
            border-radius: 8px;
            outline: none;
            box-shadow: none;
            display: flex; /* Make it a flex container to align pseudo-elements */
            align-items: center;
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
            background-color: #d9a36a;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            outline: none;
            margin-right: 12px;
        }
        .custom-file-input:hover::before {
            background-color: #c48950;
        }
        .custom-file-input:active::before {
            background-color: #b07845;
        }
        /* Style for filename display */
        #upload_ktp-filename {
            flex-grow: 1; /* Make it take remaining space */
            overflow: hidden; /* Hide overflow text */
            text-overflow: ellipsis; /* Add ellipsis */
            white-space: nowrap; /* Prevent wrapping */
            margin-left: 0; /* Remove default margin from p tag */
        }
    </style>

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
        const registrationForm = document.getElementById('registrationForm');
        const serverErrorsDiv = document.getElementById('laravel-server-errors');

        // Function to display a specific step
        function showStep(step) {
            formSteps.forEach((s, index) => {
                s.classList.add('hidden');
                if (index + 1 === step) {
                    s.classList.remove('hidden');
                }
            });

            // Update step indicators
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

            // Update step lines
            stepLines.forEach((line, index) => {
                if (index + 1 < step) {
                    line.classList.add('active');
                } else {
                    line.classList.remove('active');
                }
            });

            // Hide server errors when changing step via JS
            if (serverErrorsDiv) {
                serverErrorsDiv.classList.add('hidden');
            }
        }

        // Validate current step before moving to next
        function validateStep(step) {
            let isValid = true;
            const errors = {};

            // Hide all previous JS validation error messages
            document.querySelectorAll('p[id$="-error"]').forEach(p => p.classList.add('hidden'));

            // Hide server errors if JS validation is running
            if (serverErrorsDiv) {
                serverErrorsDiv.classList.add('hidden');
            }

            if (step === 1) {
                const email = registrationForm.elements['email'].value.trim();
                const password = registrationForm.elements['password'].value.trim();
                const passwordConfirmation = registrationForm.elements['password_confirmation'].value.trim();

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

                // Display JS validation errors
                for (const field in errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errors[field];
                        errorElement.classList.remove('hidden');
                    }
                }

            } else if (step === 2) {
                // IMPORTANT: Use 'name' here, consistent with input name in HTML
                const namaLengkap = registrationForm.elements['name'].value.trim();
                const alamat = registrationForm.elements['alamat'].value.trim();
                const umur = parseInt(registrationForm.elements['umur'].value);
                const pekerjaan = registrationForm.elements['pekerjaan'].value.trim();
                const noTelp = registrationForm.elements['no_telp'] ? registrationForm.elements['no_telp'].value.trim() : '';

                if (!namaLengkap) { errors.name = 'Nama lengkap tidak boleh kosong.'; isValid = false; }
                if (!alamat) { errors.alamat = 'Alamat tidak boleh kosong.'; isValid = false; }

                if (isNaN(umur) || umur < 17) {
                    errors.umur = 'Umur minimal 17 tahun.';
                    isValid = false;
                }

                if (!pekerjaan) { errors.pekerjaan = 'Pekerjaan tidak boleh kosong.'; isValid = false; }
                if (noTelp && !/^\d+$/.test(noTelp)) {
                    errors.no_telp = 'Nomor telepon hanya boleh berisi angka.';
                    isValid = false;
                } else if (!noTelp) {
                    errors.no_telp = 'Nomor telepon tidak boleh kosong.';
                    isValid = false;
                }

                for (const field in errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errors[field];
                        errorElement.classList.remove('hidden');
                    }
                }
            } else if (step === 3) {
                const uploadKtp = registrationForm.elements['upload_ktp'].files.length > 0;
                if (!uploadKtp) {
                    errors.upload_ktp = 'Foto KTP wajib diunggah.';
                    isValid = false;
                } else {
                    const file = registrationForm.elements['upload_ktp'].files[0];
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

        // Function to go to the next step
        function nextStep(current) {
            if (validateStep(current)) {
                currentStep = current + 1;
                showStep(currentStep);
            }
        }

        // Function to go back to the previous step
        function prevStep(current) {
            currentStep = current - 1;
            showStep(currentStep);
        }

        // Initialize: Show the first step when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Check if there are Laravel errors (from old input) when the page reloads
            const hasErrors = @json($errors->any());
            if (hasErrors) {
                if (@json($errors->has('email')) || @json($errors->has('password')) || @json($errors->has('password_confirmation'))) {
                    currentStep = 1;
                } else if (@json($errors->has('name')) || @json($errors->has('alamat')) || @json($errors->has('umur')) || @json($errors->has('pekerjaan')) || @json($errors->has('no_telp'))) {
                    currentStep = 2;
                } else if (@json($errors->has('upload_ktp'))) {
                    currentStep = 3;
                } else {
                    currentStep = 1; // Default to step 1 if not clear
                }
                showStep(currentStep);
                if (serverErrorsDiv) {
                    serverErrorsDiv.classList.remove('hidden'); // Ensure server error div is visible
                }
            } else {
                showStep(currentStep); // Show step 1 normally
            }
        });

        // Update KTP file name display
        uploadKtpInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                uploadKtpFilenameDisplay.textContent = this.files[0].name;
                uploadKtpFilenameDisplay.classList.remove('hidden');
            } else {
                uploadKtpFilenameDisplay.textContent = 'Belum ada file yang dipilih';
            }
        });
    </script>
</x-guest-layout>