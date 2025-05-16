@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'text-sm text-error flex gap-2 items-center']) }}>
    <x-lucide-triangle-alert class="h-5 w-5 mr-2"/>
    {{ $message }}
</p>
@enderror
