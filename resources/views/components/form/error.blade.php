@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'mt-2 mb-4 font-medium text-sm text-error flex gap-2 items-center']) }}>
    <x-lucide-triangle-alert class="h-5 w-5"/>
    {{ $message }}
</p>
@enderror
