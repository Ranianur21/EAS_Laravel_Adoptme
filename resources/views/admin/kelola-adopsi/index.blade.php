<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Adopsi</title>
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
<body class="bg-amber-50 min-h-screen">
    <!-- Header -->
    <header class="bg-amber-800 text-white p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold">Kelola Data Adopsi</h1>
            <div class="space-x-2">
                <a href="{{ route('dashboard.admin') }}" class="bg-amber-600 hover:bg-amber-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Table Header -->
            <div class="bg-amber-100 p-4 border-b">
                <h2 class="text-lg font-semibold text-amber-900">Daftar Pengajuan Adopsi</h2>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-amber-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Nama Pengguna</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Nama Hewan</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Alamat</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Tanggal Pengajuan</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-200">
                        @forelse($adopsi as $index => $a)
                        <tr class="hover:bg-amber-50 transition-colors">
                            <td class="px-4 py-3 text-sm">{{ $adopsi->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->hewan->nama ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->user->alamat ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $a->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($a->status == 'Menunggu Konfirmasi')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $a->status }}
                                    </span>
                                @elseif($a->status == 'Disetujui')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $a->status }}
                                    </span>
                                @elseif($a->status == 'Ditolak')
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $a->status }}
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">
                                        Tidak diketahui
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm space-x-2">
                                <!-- Edit Status Buttons -->
                                @if($a->status == 'Menunggu Konfirmasi')
                                    <form action="{{ route('adopsi.updateStatus', $a->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Disetujui">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('adopsi.updateStatus', $a->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                            Tolak
                                        </button>
                                    </form>
                                @endif
                                
                                <!-- Delete Button -->
                                <button onclick="showDeleteModal({{ $a->adopsi_id }}, '{{ $a->pengguna->name ?? 'N/A' }}', '{{ $a->hewan->nama ?? 'N/A' }}')" 
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada data pengajuan adopsi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Pagination -->
            <div class="bg-amber-100 px-4 py-3 border-t">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-amber-800">
                        Menampilkan {{ $adopsi->count() }} dari {{ $adopsi->total() }} pengajuan adopsi
                    </div>
                    <div class="flex space-x-2">
                        @if ($adopsi->onFirstPage())
                            <button class="bg-amber-300 text-white px-3 py-1 rounded text-xs font-medium" disabled>
                                Sebelumnya
                            </button>
                        @else
                            <a href="{{ $adopsi->previousPageUrl() }}" class="bg-amber-600 hover:bg-amber-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                Sebelumnya
                            </a>
                        @endif

                        @if ($adopsi->hasMorePages())
                            <a href="{{ $adopsi->nextPageUrl() }}" class="bg-amber-600 hover:bg-amber-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                Selanjutnya
                            </a>
                        @else
                            <button class="bg-amber-300 text-white px-3 py-1 rounded text-xs font-medium" disabled>
                                Selanjutnya
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('adopsi.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Tambah Data
            </a>
            <button class="bg-amber-800 hover:bg-amber-900 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Export Data
            </button>
        </div>
    </main>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus data adopsi untuk pengguna 
                    <span id="penggunaName" class="font-semibold"></span> 
                    dan hewan <span id="hewanName" class="font-semibold"></span>? 
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-end space-x-4">
                    <button onclick="hideDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors">
                        Batal
                    </button>
                    <form id="deleteForm" action="" method="POST" class="inline">
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
        // Show delete modal
        function showDeleteModal(adopsiId, penggunaName, hewanName) {
            document.getElementById('penggunaName').textContent = penggunaName;
            document.getElementById('hewanName').textContent = hewanName;
            document.getElementById('deleteForm').action = `/adopsi/${adopsiId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Hide delete modal
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });


    </script>
</body>
</html>