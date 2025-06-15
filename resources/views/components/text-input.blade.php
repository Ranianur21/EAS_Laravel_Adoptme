@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]']) !!}>