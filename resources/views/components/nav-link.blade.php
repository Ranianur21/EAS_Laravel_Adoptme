@props(['active']) 

@php
    $activeClasses = 'bg-[#d9a36a] text-white'; 
    $inactiveClasses = 'text-gray-300 hover:bg-[#d9a36a] hover:text-white'; 

    $classes = ($active ?? false)
                ? $activeClasses . ' rounded-md px-3 py-2 text-sm font-medium' 
                : $inactiveClasses . ' rounded-md px-3 py-2 text-sm font-medium'; 
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}
   aria-current="{{ ($active ?? false) ? 'page' : 'false' }}"> 
    {{ $slot }}
</a>