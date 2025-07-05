@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-input border-border text-primary focus:border-border focus:ring-ring rounded-md shadow-xs']) !!}>
