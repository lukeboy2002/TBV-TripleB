<a wire:navigate {{ $attributes->merge(['class' => 'flex']) }}>
    <x-logo.icon/>
    <span class="self-center flex text-2xl font-black whitespace-nowrap text-secondary font-secondary">
        {{ config('app.name') }}
    </span>
</a>