@props([
    'id',                 // unieke id basis, bv. "bold"
    'sr' => '',           // screenreader label
    'title' => '',        // tooltip text
    'class' => '',        // extra button classes
    'icon' => null,       // lucide icon-naam, bv. "bold"
    'iconClass' => 'w-5 h-5', // classes voor het icon
])

@php
    $btnId = $id ? "toggle{$id}Button" : 'btn-' . \Illuminate\Support\Str::uuid();
    $tooltipId = $id ? "tooltip{$id}" : 'tooltip-' . \Illuminate\Support\Str::uuid();
@endphp

<button
        id="{{ $btnId }}"
        type="button"
        data-tooltip-target="{{ $tooltipId }}"
        {{ $attributes->merge([
            'class' => "p-1.5 text-primary-muted rounded-sm cursor-pointer hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-600 {$class}"
        ]) }}
>
    @if($icon)
        <x-dynamic-component :component="'lucide-' . $icon" :class="$iconClass"/>
    @else
        {{ $slot }}
    @endif

    @if($sr)
        <span class="sr-only">{{ $sr }}</span>
    @endif
</button>

<div
        id="{{ $tooltipId }}"
        role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip"
>
    {{ $title }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>

{{--    <button id="toggleBoldButton" data-tooltip-target="tooltip-bold" type="button"--}}
{{--            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">--}}
{{--        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--             fill="none" viewBox="0 0 24 24">--}}
{{--            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                  d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"/>--}}
{{--        </svg>--}}
{{--        <span class="sr-only">Bold</span>--}}
{{--    </button>--}}
{{--    <div id="tooltip-bold" role="tooltip"--}}
{{--         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">--}}
{{--        Toggle bold--}}
{{--        <div class="tooltip-arrow" data-popper-arrow></div>--}}
{{--    </div>--}}