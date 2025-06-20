<x-app-layout>
   @include('user.home_content', [
    'hewansTersedia' => $hewansTersedia,
    'hewansDiadopsi' => $hewansDiadopsi,
    'artikelEdukasi' => $artikelEdukasi
    ])
</x-app-layout>
