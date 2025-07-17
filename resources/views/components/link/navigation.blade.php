@props(['active', 'icon' => null])

@php
    $classes = ($active ?? false)
                ? 'items-center flex gap-2 px-1 text-base font-medium leading-5 text-secondary focus:outline-hidden focus:text-secondary transition duration-150 ease-in-out'
                : 'items-center flex gap-2 px-1 text-base font-medium leading-5 text-primary hover:text-secondary focus:outline-hidden focus:text-secondary transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        @php
            $componentName = 'lucide-' . $icon;
        @endphp
        <x-dynamic-component :component="$componentName" class="w-6 h-6 sm:w-5 sm:h-5"/>
    @endif
    {{ $slot }}
</a>
