@props(['color', 'active' => false])

@php
    $baseColors = match ($color) {
        'blue' => 'bg-blue-100 text-blue-800',
        'gray' => 'bg-gray-100 text-gray-800',
        'red' => 'bg-red-100 text-red-800',
        'green' => 'bg-green-100 text-green-800',
        'yellow' => 'bg-yellow-100 text-yellow-800',
        'indigo' => 'bg-indigo-100 text-indigo-800',
        'purple' => 'bg-purple-100 text-purple-800',
        'pink' => 'bg-pink-100 text-pink-800',
        default => 'bg-orange-100 text-orange-800',
    };

    $activeColors = match ($color) {
        'blue' => 'bg-blue-100 text-blue-800 border-blue-500',
        'gray' => 'bg-gray-100 text-gray-800 border-gray-500',
        'red' => 'bg-red-100 text-red-800 border-red-500',
        'green' => 'bg-green-100 text-green-800 border-green-500',
        'yellow' => 'bg-yellow-100 text-yellow-800 border-yellow-500',
        'indigo' => 'bg-indigo-100 text-indigo-800 border-indigo-500',
        'purple' => 'bg-purple-100 text-purple-800 border-purple-500',
        'pink' => 'bg-pink-100 text-pink-800 border-pink-500',
        default => 'bg-orange-100 text-orange-800 border-orange-500',
    };

    $color = $active ? $activeColors : $baseColors;
@endphp

<button type="button" {{ $attributes->merge(['class' => "$color text-xs px-4 py-1 text-neutral-950 rounded-r-lg"]) }}>
    {{ $slot }}
</button>