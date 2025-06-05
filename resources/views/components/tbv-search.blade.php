<div x-data="{ query: '{{ request('search', '') }}'}"
     x-on:keyup.enter.window="$dispatch('search',{ search : query})"
     id="search">


    <div class="flex items-center max-w-sm mx-auto">
        <x-label for="query" class="sr-only">Search</x-label>
        <div class="relative w-full">
            <input x-model="query"
                   type="text"
                   id="search"
                   class="block p-2.5 w-full z-20 text-sm text-primary bg-background rounded-lg border border-border/30 focus:ring-ring focus:border-border "
                   placeholder="Search..."/>
            <button type="submit"
                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-secondary rounded-e-lg border border-border hover:bg-secondary/50 focus:outline-none focus:bg-secondary/50">
                <x-lucide-search class="size-4"/>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</div>

