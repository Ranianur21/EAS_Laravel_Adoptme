@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-100 text-green-700 p-3 rounded mb-4 text-sm']) }}>
        {{ $status }}
    </div>
@endif