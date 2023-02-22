@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'text-orange-500 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 hover:text-orange-500 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-gray-200 dark:focus:ring-gray-700 transition ease-in-out duration-150'
                : 'text-gray-700 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 hover:text-orange-500 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-gray-200 dark:focus:ring-gray-700 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{--Bovenste rij is active--}}

{{--<class="px-3 py-2 text-xs font-medium">Extra small DEFAULT--}}
{{--<class="px-3 py-2 text-sm font-medium">Small--}}
{{--<class="px-5 py-2.5 text-sm font-medium">Base--}}
{{--<class="px-5 py-3 text-base font-medium">Large--}}
{{--<class="px-6 py-3.5 text-base font-medium">Extra large--}}
