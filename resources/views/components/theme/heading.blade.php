@php
    $classes = 'border-l-4 border-orange-500 pl-4 flex justify-between items-center';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <div class="text-orange-500 font-black uppercase">
        {{ $slot }}
    </div>
</div>