<div>
    {{--    <div>--}}
    {{--        <div class="md:flex sm:justify-end md:justify-between items-center py-4">--}}
    {{--            <a wire:navigate href="{{ route('posts.index') }}">All categories</a>--}}
    {{--            <x-search-box/>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="flex justify-between items-center mb-4">
        <div>
            <div class="flex items-center space-x-2 text-md text-gray-700 dark:text-gray-300">
                @if ($this->activeCategory)
                    <div>
                        Filterd by category:
                    </div>
                    <x-link-primary href="{{ route('posts.index', ['category' => $this->activeCategory->slug]) }}">
                        {{ $this->activeCategory->name }}
                    </x-link-primary>
                @endif
                @if ($this->activeTag)
                    <div>
                        Filterd by Tag:
                    </div>
                    <x-link-primary href="{{ route('posts.index', ['tag' => $this->activeTag->slug]) }}">
                        {{ $this->activeTag->name }}
                    </x-link-primary>
                @endif

                @if ($search)
                    <div>
                        Searching:
                    </div>
                    <div class="text-orange-500">{{ $search }} </div>
                @endif
                @if ($this->activeCategory || $this->activeTag || $search)
                    <div class="flex items-center text-orange-500"
                         wire:click="clearFilters()">
                        <x-heroicon-o-x-circle class="size-5 mr-2"/>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex space-x-4">
            <button class="{{ $sort === "desc" ? "flex items-center text-orange-500 border-b border-orange-500" : "flex items-center text-gray-500 dark:text-gray-400" }} py-1"
                    wire:click="setSort('desc')"
            >
                <x-heroicon-s-bars-arrow-down class="mr-2 size-4"/>
                {{ __('Latest') }}
            </button>
            <button class="{{ $sort === "asc" ? "flex items-center text-orange-500 border-b border-orange-500" : "flex items-center text-gray-500 dark:text-gray-400" }} py-1"
                    wire:click="setSort('asc')"
            >
                <x-heroicon-s-bars-arrow-up class="mr-2 size-4"/>
                {{ __('Oldest') }}
            </button>

            <div class="flex items-center space-x-2 text-xs text-gray-700 dark:text-gray-50">
                <x-search-box/>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($this->posts as $post)
            <x-card-blogpost :post="$post"/>
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
