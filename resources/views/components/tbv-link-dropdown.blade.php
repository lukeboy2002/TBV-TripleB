@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'items-center px-4 text-sm font-medium leading-5 text-secondary focus:outline-hidden focus:text-secondary transition duration-150 ease-in-out'
                : 'items-center px-4 text-sm font-medium leading-5 text-primary hover:text-secondary focus:outline-hidden focus:text-secondary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>