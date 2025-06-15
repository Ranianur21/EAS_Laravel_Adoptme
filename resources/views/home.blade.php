{{-- resources/views/home.blade.php --}}
@auth
    <x-app-layout>
        @include('user.home_content', [
            'hewansTersedia' => $hewansTersedia,
            'hewansDiadopsi' => $hewansDiadopsi,
        ])
    </x-app-layout>
@else
    <x-guest-layout>
        @include('user.home_content', [
            'hewansTersedia' => $hewansTersedia,
            'hewansDiadopsi' => $hewansDiadopsi,
        ])
    </x-guest-layout>
@endauth
