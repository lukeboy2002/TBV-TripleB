@props([
    'truncate' => false,
    'textWrap' => false
    ])

<div class="flex justify-between gap-2 items-end mb-2 w-full">
    <div class="min-w-0 text-secondary font-secondary font-bold text-xl uppercase
        {{ $truncate ? 'truncate' : '' }}
        {{ $textWrap ? 'text-wrap' : '' }}">
        {{ $slot }}
    </div>

    <div class="w-1/6 md:flex-1 border-t-4 border-primary mb-1"></div>
</div>