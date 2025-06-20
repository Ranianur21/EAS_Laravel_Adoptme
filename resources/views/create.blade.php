<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hewan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brown-light': '#D2B48C',
                        'brown-medium': '#A0826D',
                        'brown-dark': '#8B4513'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-amber-800 text-white p-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <h1 class="text-xl font-semibold">Tambah Hewan</h1>
            <div class="space-x-2">
                <button onclick="goBack()" class="bg-white text-amber-800 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Kembali
                </button>
                <button onclick="logout()" class="bg-white text-amber-800 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Logout
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-6 max-w-2xl">
        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-amber-800 mb-8">Form Tambah Hewan</h2>
            
            <form id="formTambahHewan" action="{{ route('titip.hewan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Nama Hewan -->
                <div>
                    <label for="namaHewan" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Hewan
                    </label>
                    <input type="text" 
                           
                           name="nama" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors"
                           placeholder="Masukkan nama hewan">
                </div>

                <!-- Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis
                    </label>
                    <input type="text" 
                          
                           name="jenis" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors"
                           placeholder="Contoh: Anjing, Kucing, Kelinci">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="jenisKelamin" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Kelamin
                    </label>
                    <select 
                            name="jenis_kelamin" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors bg-white">
                        <option value="">-- Pilih --</option>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>

                <!-- Usia (dalam tahun) -->
                <div>
                    <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                        Usia (dalam tahun)
                    </label>
                    <input type="number" 
                          
                           name="usia" 
                           required
                           min="0"
                           step="0.1"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors"
                           placeholder="Contoh: 2">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <select 
                            name="status" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors bg-white">
                        <option value="">-- Pilih --</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Diadopsi">Diadopsi</option>
                        
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                              name="deskripsi" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-vertical"
                              placeholder="Tulis deskripsi singkat tentang hewan..."></textarea>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Gambar
                    </label>
                    <div class="relative">
                        <input type="file" 
                               
                               name="gambar" 
                               accept="image/*"
                               onchange="handleFileSelect(event)"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Format yang didukung: JPG, PNG, GIF. Maksimal 5MB.
                    </p>
                    
                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar:</p>
                        <img id="previewImg" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-amber-800 hover:bg-amber-900 text-white py-3 px-6 rounded-lg font-medium text-lg transition-colors focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Tambah Hewan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Berhasil!</h3>
                    <p class="text-gray-600 mb-6">Data hewan berhasil ditambahkan.</p>
                    <div class="flex justify-center space-x-4">
                        <button onclick="closeModal()" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle file selection and preview
        function handleFileSelect(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            
            if (file) {
                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar.');
                    event.target.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        }

        // Handle form submission
        function handleSubmit(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(event.target);
            const data = {
                namaHewan: formData.get('namaHewan'),
                jenis: formData.get('jenis'),
                jenisKelamin: formData.get('jenisKelamin'),
                usia: formData.get('usia'),
                status: formData.get('status'),
                deskripsi: formData.get('deskripsi'),
                gambar: formData.get('gambar')
            };
            
            // Validate required fields
            if (!data.namaHewan || !data.jenis || !data.jenisKelamin || !data.usia || !data.status) {
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }
            
            // Simulate API call
            setTimeout(() => {
                console.log('Data yang akan disimpan:', data);
                showSuccessModal();
            }, 1000);
        }

        // Show success modal
        function showSuccessModal() {
            document.getElementById('successModal').classList.remove('hidden');
        }

        // Close modal and reset form
        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('formTambahHewan').reset();
            document.getElementById('imagePreview').classList.add('hidden');
        }

        // Go back function
        function goBack() {
            if (confirm('Apakah Anda yakin ingin kembali? Data yang belum disimpan akan hilang.')) {
                // Redirect to previous page or animal list
                window.history.back();
            }
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil!');
                // Redirect to login page
            }
        }

        // Auto-resize textarea
        document.getElementById('deskripsi').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Add some form validation feedback
        document.querySelectorAll('input[required], select[required]').forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.add('border-red-300');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-gray-300');
                }
            });
        });
    </script>
</body>
</html>