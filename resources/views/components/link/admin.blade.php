@props(['active' => false, 'icon' => null])

@php
    $base = 'flex items-center px-4 py-4 transition-all duration-200 text-base font-medium leading-5';
    $inactive = 'hover:bg-background-hover hover:text-secondary text-primary focus:outline-hidden focus:text-secondary';
    $activeClasses = 'bg-background-hover text-secondary focus:outline-hidden focus:text-secondary';
    $classes = $base . ' ' . ($active ? $activeClasses : $inactive);

    // sm: label onzichtbaar, zichtbaar bij hover/focus op .group (aside)
    // md+: label altijd zichtbaar
    $labelClasses = 'ml-3 whitespace-nowrap transition-opacity duration-300
                     opacity-0 group-hover:opacity-100 group-focus-within:opacity-100
                     2xl:opacity-100';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        @php $componentName = 'lucide-' . $icon; @endphp
        <x-dynamic-component :component="$componentName" class="w-6 h-6 flex-shrink-0"/>
    @endif
    <span class="{{ $labelClasses }}">{{ $slot }}</span>
</a>