@php
    $classes = 'text-orange-500 hover:text-gray-700 dark:hover:text-white  ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
