@props([
    'disabled' => false,
    'icon' => null  // Pass a custom icon name (e.g., 'user', 'mail', etc.) to use with Lucide icons
])

<div class="relative w-full">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
        @if ($icon)
            @php
                $componentName = 'lucide-' . $icon;
            @endphp
            <x-dynamic-component :component="$componentName" class="w-5 h-5 text-primary-muted"/>
        @endif
    </div>
    <input {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge(['class' => 'bg-transparent text-sm text-primary-muted placeholder-primary-muted rounded-lg block w-full ' . ($icon ? 'ps-10' : 'ps-3.5') . ' p-2.5 border border-secondary/30 focus:border-secondary focus:outline-none focus:ring-0']) !!} />
</div>
