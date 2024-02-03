@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'text-center text-white rounded-lg bg-orange-500 hover:transparent border border-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 focus:bg-orange-500 transition ease-in-out duration-150'
                : 'text-center text-gray-700 dark:text-white rounded-lg hover:bg-orange-500 hover:text-white border border-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 focus:bg-orange-500 transition ease-in-out duration-150';
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
