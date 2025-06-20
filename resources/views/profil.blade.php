<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-[#4a2c1f] mb-4">{{ __('Informasi Profil') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Nama Lengkap:</p>
                            <p class="text-lg text-gray-800">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Email:</p>
                            <p class="text-lg text-gray-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Alamat:</p>
                            <p class="text-lg text-gray-800">{{ $user->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Umur:</p>
                            <p class="text-lg text-gray-800">{{ $user->umur ?? '-' }} tahun</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Pekerjaan:</p>
                            <p class="text-lg text-gray-800">{{ $user->pekerjaan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Nomor Telepon:</p>
                            <p class="text-lg text-gray-800">{{ $user->no_telp ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-semibold text-gray-600 mb-2">Foto KTP:</p>
                            @if ($user->path_foto_ktp)
                                <img src="{{ asset('storage/' . $user->path_foto_ktp) }}" alt="Foto KTP" class="w-full md:w-1/2 lg:w-1/3 rounded-lg shadow-md">
                                <p class="text-xs text-gray-500 mt-2">KTP Anda sudah diunggah.</p>
                            @else
                                <p class="text-base text-red-500">Foto KTP belum diunggah.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('edit_profil') }}" class="bg-[#8b5e34] hover:bg-[#71492a] text-white font-bold py-2 px-4 rounded transition duration-300">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-[#4a2c1f] mb-4">{{ __('Riwayat Pengajuan Adopsi') }}</h3>

                    @if ($riwayatAdopsi->isEmpty())
                        <p class="text-gray-700">Anda belum memiliki riwayat pengajuan adopsi.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Pengajuan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Hewan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis Hewan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($riwayatAdopsi as $adopsi)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $adopsi->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $adopsi->hewan->nama ?? 'Hewan Tidak Ditemukan' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $adopsi->hewan->jenis ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @php
                                                    $statusClass = '';
                                                    switch ($adopsi->status) {
                                                        case 'Menunggu Verifikasi':
                                                            $statusClass = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800';
                                                            break;
                                                        case 'Disetujui':
                                                            $statusClass = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800';
                                                            break;
                                                        case 'Ditolak':
                                                            $statusClass = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800';
                                                            break;
                                                        default:
                                                            $statusClass = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="{{ $statusClass }}">
                                                    {{ ucfirst($adopsi->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('adopsi.konfirmasi', $adopsi->id) }}" class="text-[#8b5e34] hover:text-[#71492a] mr-3">Detail</a>
                                                {{-- Anda bisa menambahkan tombol lain seperti "Batalkan" jika status masih menunggu verifikasi --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>