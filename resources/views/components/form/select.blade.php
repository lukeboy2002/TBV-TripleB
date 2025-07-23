@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent text-sm text-primary-muted placeholder-primary-muted rounded-lg block p-2.5 border border-secondary/30 focus:border-secondary focus:outline-none focus:ring-0']) !!}>
    {{ $slot }}
</select>




