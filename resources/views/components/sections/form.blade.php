@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-sections.title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-sections.title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-4 py-5 bg-white border-x border-t border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 sm:p-6 {{ isset($actions) ? 'sm:rounded-tl-lg sm:rounded-tr-lg' : 'sm:rounded-lg' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 pt-3 pb-6 bg-white border-x border-b border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 text-right sm:px-6 shadow sm:rounded-bl-lg sm:rounded-br-lg">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
