@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-primary mb-2 whitespace-nowrap']) }}>
    {{ $value ?? $slot }}
</label>
