@props(['title', 'count', 'color', 'icon'])

@php
    // Convert props to strings to avoid ComponentSlot issues
    $colorStr = (string) $color;

    // Define color classes based on the color prop
    $colorClasses = [
        'indigo' => [
            'text' => 'text-indigo-600',
            'bg' => 'bg-indigo-400',
            'border' => 'border-indigo-600'
        ],
        'green' => [
            'text' => 'text-green-600',
            'bg' => 'bg-green-400',
            'border' => 'border-green-600'
        ],
        'red' => [
            'text' => 'text-red-600',
            'bg' => 'bg-red-400',
            'border' => 'border-red-600'
        ],
        'blue' => [
            'text' => 'text-blue-600',
            'bg' => 'bg-blue-400',
            'border' => 'border-blue-600'
        ],
    ];

    $textColor = $colorClasses[$colorStr]['text'] ?? 'text-indigo-600';
    $bgColor = $colorClasses[$colorStr]['bg'] ?? 'bg-indigo-400';
    $borderColor = $colorClasses[$colorStr]['border'] ?? 'border-indigo-600';
@endphp

<div class="px-6 py-6 bg-background-accent border border-border rounded-lg shadow-xl" {{ $attributes }}>
    <div class="flex items-center justify-between">
        <span class="font-bold text-sm {{ $textColor }}">{{ $title }}</span>
    </div>
    <div class="flex items-center justify-between mt-6">
        <div>
            <svg class="w-12 h-12 p-2.5 {{ $bgColor }} bg-opacity-20 rounded-full {{ $textColor }} border {{ $borderColor }}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                      d="{{ $icon }}"></path>
            </svg>
        </div>
        <div class="flex flex-col">
            <div class="flex items-end">
                <span class="text-2xl 2xl:text-3xl font-bold">{{ $count }}</span>
            </div>
        </div>
    </div>
</div>
