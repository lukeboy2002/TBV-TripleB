@props(['icon' => 'home', 'type' => 'button'])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'p-2 bg-transparent border border-secondary/30 hover:bg-background-hover hover:border-secondary focus:outline-none focus:bg-background-hover focus:border-secondary rounded-lg flex items-center justify-center']) }}>
    @if($icon)
        <x-dynamic-component :component="'lucide-' . $icon" class="w-3 h-3"/>
    @endif
    <span class="sr-only">Icon description</span>
</button>