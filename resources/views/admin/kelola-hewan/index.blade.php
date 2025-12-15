<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Hewan</title>
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
            <h1 class="text-xl font-semibold">Kelola Hewan</h1>
            <div class="space-x-2">
                <a href="{{ route('dashboard.admin') }}" class="bg-amber-600 hover:bg-amber-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-6 max-w-7xl">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-amber-800">Daftar Hewan</h2>
            <a href="{{ route('hewan.create') }}" class="bg-amber-800 hover:bg-amber-900 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Tambah Hewan
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-amber-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Gambar</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Jenis</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Kelamin</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Usia</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($hewan as $index => $h)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-4">
                                @if($h->gambar)
                                    <!-- PERBAIKAN PATH: assets/gambar_hewan/ → assets/images/gambar_hewan/ -->
                                    <img src="{{ asset('assets/images/gambar_hewan/' . $h->gambar) }}" 
                                         alt="{{ $h->nama }}" 
                                         class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm font-medium">{{ $h->nama }}</td>
                            <td class="px-4 py-4 text-sm">{{ $h->jenis }}</td>
                            <td class="px-4 py-4 text-sm">{{ ucfirst($h->kelamin) }}</td>
                            <td class="px-4 py-4 text-sm">{{ $h->usia }} {{ $h->usia == 1 ? 'Tahun' : 'Tahun' }}</td>
                            <td class="px-4 py-4 text-sm">
                                @if($h->status == 'tersedia')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                        Tersedia
                                    </span>
                                @elseif($h->status == 'diadopsi')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">
                                        Diadopsi
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ ucfirst($h->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('hewan.edit', $h->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                        Edit
                                    </a>
                                    <span class="text-gray-300">|</span>
                                    <button onclick="confirmDelete({{ $h->id }}, '{{ $h->nama }}')" class="text-red-600 hover:text-red-800 font-medium text-sm transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Belum ada data hewan</p>
                                    <p class="text-sm">Silakan tambahkan hewan terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-4 py-3 border-t">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $hewan->count() }} dari {{ $hewan->count() }} hewan
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="mt-6 flex justify-end space-x-4">
            <a href="" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Export Data
            </a>
            <button onclick="window.print()" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Print Report
            </button>
        </div>
    </main>

    <!-- Modal untuk konfirmasi hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data hewan <span id="hewanName" class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end space-x-4">
                    <button onclick="hideDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk modal hapus
        function confirmDelete(id, nama) {
            // Isi nama hewan pada modal
            document.getElementById('hewanName').textContent = nama;

            // Update action form untuk hapus berdasarkan id hewan
            document.getElementById('deleteForm').action = `/hewan/${id}`;

            // Tampilkan modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            // Sembunyikan modal
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });

        // Auto hide success/error messages after 5 seconds
        setTimeout(function() {
            const successMsg = document.querySelector('.bg-green-100');
            const errorMsg = document.querySelector('.bg-red-100');
            
            if (successMsg) {
                successMsg.style.transition = 'opacity 0.5s';
                successMsg.style.opacity = '0';
                setTimeout(function() {
                    successMsg.remove();
                }, 500);
            }
            
            if (errorMsg) {
                errorMsg.style.transition = 'opacity 0.5s';
                errorMsg.style.opacity = '0';
                setTimeout(function() {
                    errorMsg.remove();
                }, 500);
            }
        }, 5000);

    </script>

</body>
</html>