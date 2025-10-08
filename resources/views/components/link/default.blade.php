@props(['icon' => ''])

<a wire:navigate {{ $attributes->merge(['class' => 'flex items-center text-sm font-medium text-primary-muted hover:text-secondary hover:underline focus:outline-none focus:text-secondary focus:underline ']) }}>
    @if($icon)
        <x-dynamic-component :component="'lucide-' . $icon" class="w-4 h-4 mr-1"/>
    @endif
    {{ $slot }}
</a>
