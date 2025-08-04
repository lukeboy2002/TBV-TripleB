@props(['icon' => ''])

<a {{ $attributes->merge(['class' => 'p-2 bg-transparent border border-secondary/30 hover:bg-background-hover hover:border-secondary focus:outline-none focus:bg-background-hover focus:border-secondary rounded-lg flex items-center justify-center']) }}>
    @if($icon)
        <x-dynamic-component :component="'lucide-' . $icon" class="w-4 h-4"/>
    @endif
</a>

