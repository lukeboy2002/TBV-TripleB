@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block text-white bg-orange-500 rounded-lg focus:outline-none focus:focus:ring-offset-2 focus:ring-2 ring-orange-500 transition ease-in-out duration-150'
                : 'block text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 rounded-lg focus:outline-none focus:focus:ring-offset-2 focus:ring-2 ring-orange-500   transition ease-in-out duration-150';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{--Bovenste rij is active--}}

{{--<class="px-3 py-2 text-xs font-medium">Extra small DEFAULT--}}
{{--<class="px-3 py-2 text-sm font-medium">Small--}}
{{--<class="px-5 py-2.5 text-sm font-medium">Base--}}
{{--<class="px-5 py-3 text-base font-medium">Large--}}
{{--<class="px-6 py-3.5 text-base font-medium">Extra large--}}
