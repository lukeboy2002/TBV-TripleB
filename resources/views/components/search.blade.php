<x-card.side>
    <x-slot name="header">
        Zoeken
    </x-slot>
    <div x-data="{ query: '{{ request('search', '') }}'}"
         x-on:keyup.enter.window="$dispatch('search',{ search : query})"
         id="search">
        <div class="flex items-center w-full mx-auto">
            <x-label for="query" class="sr-only">Search</x-label>
            <div class="relative w-full">
                <x-form.input x-model="query"
                              id="search"
                              name="search"
                              type="text"
                              class="block mt-1 w-full"
                              :value="old('search')"
                              icon="search"
                              placeholder="{{ __('Search...')}}"
                />
            </div>
        </div>
    </div>
</x-card.side>