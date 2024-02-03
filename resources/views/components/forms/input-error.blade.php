@props(['for'])

@error($for)
<div {{ $attributes->merge(['class' => 'mt-2 p-4 mb-4 flex items-center text-sm text-red-700 bg-red-100 rounded-lg']) }}>
    <x-icons name="error" class="mr-1"/>

    {{ $message }}
</div>
@enderror
