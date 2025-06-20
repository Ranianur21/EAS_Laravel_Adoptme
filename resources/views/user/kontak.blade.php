{{-- resources/views/user/kontak.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>AdoptMe – Kontak</title>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

{{-- ========== NAVBAR ========== --}}
<x-navbar />

<body class="bg-white text-gray-900">

{{-- ========= HERO “Hubungi Kami” ========= --}}
<section class="py-16">
    <div class="container mx-auto px-6">

        <div class="bg-white p-8 rounded-lg shadow-xl max-w-xl mx-auto text-center border border-[#E4D7C6]">
            <h2 class="text-[#8b5e34] font-semibold text-lg">Hubungi Kami</h2>
            <h3 class="text-3xl font-bold mt-2">Kami Siap Membantu!</h3>
            <p class="text-[#6d4c41] mt-4">
                Jika Anda memiliki pertanyaan atau ingin mengadopsi hewan, jangan ragu untuk menghubungi kami.
            </p>
        </div>

        {{-- ========= FORM KONTAK ========= --}}
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto mt-12 border border-[#E4D7C6]">
            <h2 class="text-3xl font-bold text-[#8b5e34] text-center mb-6">Kirim Pesan</h2>

            <form action="{{ route('kontak.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                  focus:outline-none focus:ring-[#8b5e34] focus:border-[#8b5e34] sm:text-sm" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                  focus:outline-none focus:ring-[#8b5e34] focus:border-[#8b5e34] sm:text-sm" required>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                    <textarea id="message" name="message" rows="5"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                     focus:outline-none focus:ring-[#8b5e34] focus:border-[#8b5e34] sm:text-sm" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 text-sm font-medium text-white
                               bg-[#8b5e34] hover:bg-[#6b3f21] rounded-md shadow-sm focus:outline-none
                               focus:ring-2 focus:ring-offset-2 focus:ring-[#8b5e34]">
                    Kirim Pesan
                </button>
            </form>
        </div>

        {{-- ========= INFO KONTAK ========= --}}
        <div class="mt-16 flex flex-col md:flex-row justify-center gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34] text-center">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Alamat</h4>
                <p class="text-gray-600 mt-2">Jl. Mawar No. 49, Surabaya</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34] text-center">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Email</h4>
                <p class="text-gray-600 mt-2">kontak@adoptme.com</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34] text-center">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Telepon</h4>
                <p class="text-gray-600 mt-2">+62 812‑3456‑7890</p>
            </div>
        </div>

    </div>
</section>

{{-- ========= CTA WhatsApp ========= --}}
<a href="https://wa.me/{{ urlencode('62812118001') }}"
   class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
    Chat via WhatsApp
</a>

{{-- ========= FOOTER ========= --}}
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe – Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

{{-- ========= ALERT LOGIC ========= --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(Session::get('success')),
            confirmButtonColor: '#8b5e34',
            background: '#fef8f4',
            color: '#5c3b19'
        });
    @endif

    @if (Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: @json(Session::get('error')),
            confirmButtonColor: '#8b5e34',
            background: '#fff5f5',
            color: '#9f3a38'
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Ada data yang belum valid',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#8b5e34',
            background: '#fff5f5',
            color: '#9f3a38'
        });
    @endif
});
</script>

</body>
</html>
