@php
    $classes = 'text-xs text-gray-400 dark:text-gray-50 hover:text-orange-500 dark:hover:text-orange-500 focus:ring-2 focus:outline-none focus:underline focus:decoration-orange-500  ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
