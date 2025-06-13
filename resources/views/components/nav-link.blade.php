@props(['active'=> false])

<a class="{{ $active ? 'bg-[#d9a36a] text-white' : 'text-gray-300 hover:bg-[#d9a36a] hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium"
aria-current="{{  $active ? 'page' : false }}" {{ $attributes }}>{{ $slot }}</a>