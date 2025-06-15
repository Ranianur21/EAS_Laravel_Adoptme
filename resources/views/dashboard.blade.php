<x-app-layout>
    @include('user.home_content', [
        'hewansTersedia' => $hewansTersedia,
        'hewansDiadopsi' => $hewansDiadopsi,
    ])
</x-app-layout>
