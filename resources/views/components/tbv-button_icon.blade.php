@props(['icon' => 'home', 'type' => 'button'])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'h-6 w-6 rounded-full flex items-center justify-center']) }}>
    @if($icon)
        <x-dynamic-component :component="'lucide-' . $icon" class="w-4 h-4"/>
    @endif
    <span class="sr-only">Icon description</span>
</button>