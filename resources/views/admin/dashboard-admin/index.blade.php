<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-amber-800 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Dashboard Admin</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm">Halo, Mimin {{ Auth::user()->name }}</span>
          
           <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-white text-amber-800 px-4 py-2 rounded text-sm font-medium hover:bg-gray-100 transition-colors">
        Logout
    </button>
</form>
        </div>
    </header>

    <div class="p-6 space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-4xl font-bold text-amber-800 mb-2">{{$totalPengguna}}</div>
                <div class="text-gray-600">Total Pengguna</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-4xl font-bold text-amber-800 mb-2">{{ $totalHewan}}</div>
                <div class="text-gray-600">Total Hewan</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-4xl font-bold text-amber-800 mb-2">{{ $totalAdopsi}}</div>
                <div class="text-gray-600">Total Adopsi</div>
            </div>
        </div>

        <!-- Adoption Status Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-amber-800 mb-6 text-center">Statistik Status Adopsi</h2>
            <div class="flex justify-center mb-4">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-yellow-400 rounded"></div>
                        <span class="text-sm text-gray-600">Menunggu Konfirmasi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-green-500 rounded"></div>
                        <span class="text-sm text-gray-600">Disetujui</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-red-500 rounded"></div>
                        <span class="text-sm text-gray-600">Ditolak</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <canvas id="adoptionStatusChart" width="300" height="300"></canvas>
            </div>
        </div>

        <!-- Monthly Adoption Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-amber-800 mb-6 text-center">Jumlah Adopsi per Bulan</h2>
            <div class="mb-4">
                <div class="flex items-center gap-2 justify-center">
                    <div class="w-4 h-4 bg-amber-800 rounded"></div>
                    <span class="text-sm text-gray-600">Jumlah Adopsi</span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="monthlyAdoptionChart"></canvas>
            </div>
        </div>

        <!-- Animal Types Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-amber-800 mb-6 text-center">Jenis Hewan yang Diadopsi</h2>
            <div class="flex justify-center mb-4">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-orange-500 rounded"></div>
                        <span class="text-sm text-gray-600">Kucing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-blue-500 rounded"></div>
                        <span class="text-sm text-gray-600">Anjing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-green-500 rounded"></div>
                        <span class="text-sm text-gray-600">Kelinci</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-6">
                <canvas id="animalTypesChart" width="300" height="300"></canvas>
            </div>
            <div class="flex justify-center gap-4">
                <a href="{{ route('hewan.index') }}" class="bg-amber-800 text-white px-6 py-2 rounded-lg hover:bg-amber-900 transition-colors">
                    Kelola Hewan
                </a>
                <a href="{{ route('adopsi.index') }}" class="bg-amber-800 text-white px-6 py-2 rounded-lg hover:bg-amber-900 transition-colors">
                    Kelola Adopsi
                </a>
                <button onclick="window.print()" class="bg-amber-800 hover:bg-amber-900 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Print Report
            </button>
            </div>
        </div>
    </div>

    <script>
        // Adoption Status Pie Chart
        const adoptionStatusCtx = document.getElementById('adoptionStatusChart').getContext('2d');
        new Chart(adoptionStatusCtx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [1, 3, 2], // Menunggu, Disetujui, Ditolak
                    backgroundColor: [
                        '#fbbf24', // yellow-400
                        '#10b981', // green-500
                        '#ef4444'  // red-500
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Monthly Adoption Bar Chart
        const monthlyAdoptionCtx = document.getElementById('monthlyAdoptionChart').getContext('2d');
        new Chart(monthlyAdoptionCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Jumlah Adopsi',
                    data: [0, 0, 0, 2, 4, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#92400e', // amber-800
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4.5,
                        ticks: {
                            stepSize: 0.5
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Animal Types Doughnut Chart
        const animalTypesCtx = document.getElementById('animalTypesChart').getContext('2d');
        new Chart(animalTypesCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [6, 1, 0], // Kucing, Anjing, Kelinci
                    backgroundColor: [
                        '#f97316', // orange-500
                        '#3b82f6', // blue-500
                        '#10b981'  // green-500
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '50%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html>