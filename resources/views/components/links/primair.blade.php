@php
    $classes = 'text-xs font-bold text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500  ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
