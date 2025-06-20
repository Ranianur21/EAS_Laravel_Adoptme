<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Adopsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-amber-800 text-white p-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <h1 class="text-xl font-semibold">Tambah Adopsi</h1>
        </div>
    </header>

    <main class="container mx-auto p-6 max-w-2xl">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-amber-800 mb-8">Form Tambah Adopsi</h2>
            
            <form action="{{ route('adopsi.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Pilih Hewan -->
                <div>
                    <label for="hewan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Hewan <span class="text-red-500">*</span>
                    </label>
                    <select 
                            id="hewan_id"
                            name="hewan_id" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors bg-white">
                        <option value="">-- Pilih Hewan --</option>
                        @foreach ($hewan as $h)
                            <option value="{{ $h->hewan_id }}">{{ $h->nama }} - {{ $h->jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Pengguna -->
                <div>
                    <label for="pengguna_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Pengguna (Pengadopsi) <span class="text-red-500">*</span>
                    </label>
                    <select 
                            id="pengguna_id"
                            name="pengguna_id" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors bg-white">
                        <option value="">-- Pilih Pengguna --</option>
                        @foreach ($pengguna as $p)
                            <option value="{{ $p->pengguna_id }}">{{ $p->name }} - {{ $p->email }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="reset" class="w-full bg-amber-800 hover:bg-amber-900 text-white py-3 px-6 rounded-lg font-medium text-lg transition-colors focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Tambah Adopsi
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
