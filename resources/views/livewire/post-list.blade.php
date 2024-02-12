<div class="max-w-6xl px-4 sm:px-6 lg:px-4">
    <div class="flex justify-between items-center h-6">
        <div class="flex">
            <x-theme.heading>Blog</x-theme.heading>
            <div class="pl-12 flex space-x-4 items-center">
                @if ($this->activeCategory)
                    <x-badges.default wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory()->slug]) }}" :Color="$this->activeCategory()->color">{{ $this->activeCategory()->title }}</x-badges.default>
                @endif
                @if ($search)
                    <div class="flex space-x-2 text-sm">
                        <div class="text-gray-900 dark:text-white">Search </div>
                        <div class="text-orange-500">{{ $search }}</div>
                    </div>
                @endif
                    @if ($this->activeCategory || $search)
                        <x-badges.clear_filter wire:click="clearFilters()" />
                    @endif
            </div>
        </div>
        <div class="flex justify-end items-center space-x-4 text-sm">
            <button class="{{ $sort === 'desc' ? 'text-orange-500' : 'text-gray-900 dark:text-white' }} py-4"
                    wire:click="setSort('desc')">Latest
            </button>
            <button class="{{ $sort === 'asc' ? 'text-orange-500' : 'text-gray-900 dark:text-white' }} py-4 "
                    wire:click="setSort('asc')"> Oldest
            </button>
        </div>
    </div>

    <div class="mt-4 md:grid md:grid-cols-2 md:gap-4">
        @forelse ($this->posts as $post)
            <x-cards.post
                :post="$post"
                class="md:col-span-mt-4 lg:mt-0"
            />
        @empty
            <div class="flex flex-col justify-center items-center h-40 space-y-4">
                <div class="text-orange-500"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
                <p class="text-xl font-bold tracking-tight text-gray-700 dark:text-white">No records found</p>
            </div>
        @endforelse
    </div>
    <div class="py-6">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
