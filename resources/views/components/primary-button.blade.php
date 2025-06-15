<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition']) }}>
    {{ $slot }}
</button>