<x-theme.heading>Search</x-theme.heading>
<div class="mt-4">
    <div x-data="{ query: '{{ request('search', '') }}' }" x-on:keyup.enter.window="$dispatch('search',{ search : query })" id="search-box">
        <x-forms.input x-model="query" type="text" placeholder="Search" />
        <div class="flex justify-end pt-4">
            <x-buttons.primary x-on:click="$dispatch('search',{ search : query })" class="px-3 py-2 text-xs font-medium">Search</x-buttons.primary>
        </div>
    </div>
</div>
