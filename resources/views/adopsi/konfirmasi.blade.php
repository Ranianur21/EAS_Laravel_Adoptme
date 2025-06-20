<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pengajuan Adopsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #F5DEB3;">
                <div class="p-6 text-gray-900 text-center">
                    {{-- Icon Checklist SVG (Tailwind CSS Heroicons) --}}
                    <svg class="mx-auto h-24 w-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <h3 class="text-3xl font-bold mt-4 mb-2" style="color: #A0522D;">Pengajuan Berhasil Dikirim!</h3>
                    <p class="text-lg text-gray-700 mb-6">Terima kasih telah mengajukan adopsi hewan. Pengajuan Anda telah berhasil kami terima dan saat ini sedang dalam proses **Menunggu Konfirmasi**.</p>
                    <p class="text-gray-600 mb-4">Tim kami akan segera meninjau pengajuan Anda dan menghubungi Anda melalui email untuk langkah selanjutnya.</p>

                    <div class="mt-8 flex flex-col space-y-4">
                        {{-- Tombol untuk kembali ke Dashboard --}}
                        <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 font-semibold rounded-md shadow-md" style="background-color: #A0522D; color: #FFFFFF; text-decoration: none;">
                           Lihat Riwayat Adopsi Saya 
                        </a>
                        {{-- Tombol untuk melihat Riwayat Adopsi di Profil --}}
                        <a href="{{ route('profil') }}" class="inline-block px-6 py-3 font-semibold rounded-md border border-gray-400" style="background-color: #FFFFFF; color: #A0522D; text-decoration: none;">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>