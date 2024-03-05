@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center p-2 text-sm font-medium text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:bg-gray-700 group transition duration-150 ease-in-out'
                : 'flex items-center p-2 text-sm font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
