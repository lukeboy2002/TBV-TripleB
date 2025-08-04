<a wire:navigate {{ $attributes->merge(['class' => 'text-sm font-medium text-primary-muted hover:text-secondary hover:underline focus:outline-none focus:text-secondary focus:underline ']) }}>
    {{ $slot }}
</a>
