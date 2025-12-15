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
                                    <button onclick="showConfirmModal('approve', {{ $a->id }}, '{{ $a->user->name ?? 'N/A' }}', '{{ $a->hewan->nama ?? 'N/A' }}')" 
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                        Setujui
                                    </button>
                                    <button onclick="showConfirmModal('reject', {{ $a->id }}, '{{ $a->user->name ?? 'N/A' }}', '{{ $a->hewan->nama ?? 'N/A' }}')" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors">
                                        Tolak
                                    </button>
                                @endif
                                
                                <!-- Delete Button -->
                                <button onclick="showConfirmModal('delete', {{ $a->id }}, '{{ $a->user->name ?? 'N/A' }}', '{{ $a->hewan->nama ?? 'N/A' }}')" 
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
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl">
                <div class="flex items-center mb-4">
                    <div id="modalIcon" class="w-12 h-12 rounded-full flex items-center justify-center mr-4">
                        <!-- Icon akan diisi oleh JavaScript -->
                    </div>
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                </div>
                <p id="modalMessage" class="text-gray-600 mb-6 ml-16"></p>
                <div class="flex justify-end space-x-4">
                    <button onclick="hideConfirmModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors">
                        Batal
                    </button>
                    <button id="confirmButton" onclick="executeAction()" class="px-4 py-2 rounded-lg font-medium transition-colors">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden forms untuk submit actions -->
    <form id="approveForm" action="" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="rejectForm" action="" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let currentAction = null;
        let currentId = null;

        function showConfirmModal(action, id, penggunaName, hewanName) {
            currentAction = action;
            currentId = id;
            
            const modal = document.getElementById('confirmModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const confirmButton = document.getElementById('confirmButton');
            
            // Konfigurasi modal berdasarkan aksi
            if (action === 'approve') {
                modalIcon.innerHTML = `
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                modalIcon.className = 'w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-green-500';
                modalTitle.textContent = 'Konfirmasi Persetujuan';
                modalMessage.innerHTML = `Apakah Anda yakin ingin <strong>menyetujui</strong> pengajuan adopsi dari <strong>${penggunaName}</strong> untuk hewan <strong>${hewanName}</strong>?`;
                confirmButton.textContent = 'Setujui';
                confirmButton.className = 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors';
            } else if (action === 'reject') {
                modalIcon.innerHTML = `
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
                modalIcon.className = 'w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-red-500';
                modalTitle.textContent = 'Konfirmasi Penolakan';
                modalMessage.innerHTML = `Apakah Anda yakin ingin <strong>menolak</strong> pengajuan adopsi dari <strong>${penggunaName}</strong> untuk hewan <strong>${hewanName}</strong>?`;
                confirmButton.textContent = 'Tolak';
                confirmButton.className = 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors';
            } else if (action === 'delete') {
                modalIcon.innerHTML = `
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                `;
                modalIcon.className = 'w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-gray-600';
                modalTitle.textContent = 'Konfirmasi Hapus';
                modalMessage.innerHTML = `Apakah Anda yakin ingin <strong>menghapus</strong> data adopsi dari <strong>${penggunaName}</strong> untuk hewan <strong>${hewanName}</strong>? <br><span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan.</span>`;
                confirmButton.textContent = 'Hapus';
                confirmButton.className = 'bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors';
            }
            
            modal.classList.remove('hidden');
        }

        function hideConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            currentAction = null;
            currentId = null;
        }

        function executeAction() {
            if (!currentAction || !currentId) return;
            
            let form;
            let actionUrl;
            
            if (currentAction === 'approve') {
                form = document.getElementById('approveForm');
                actionUrl = `/adopsi/${currentId}/approve`;
            } else if (currentAction === 'reject') {
                form = document.getElementById('rejectForm');
                actionUrl = `/adopsi/${currentId}/reject`;
            } else if (currentAction === 'delete') {
                form = document.getElementById('deleteForm');
                actionUrl = `/adopsi/${currentId}`;
            }
            
            form.action = actionUrl;
            form.submit();
        }

        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideConfirmModal();
            }
        });
    </script>
</body>
</html>