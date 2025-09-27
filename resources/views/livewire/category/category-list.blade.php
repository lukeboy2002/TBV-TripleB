<div>
    @if ($categories->count() >1 )
        <x-card.side>
            <x-slot name="header">
                {{ __('Categories')}}
            </x-slot>

            <div>
                @foreach ($categories as $category)
                    <div class="font-extrabold text-primary py-2 {{ !$loop->last ? 'border-b border-secondary/30' : '' }}">
                        <a wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}"
                           class="p-2 flex items-center gap-2">{{ $category->name }} <span
                                    class="text-xs lg:text-lg">({{ $category->posts_count }})</span>
                        </a>
                    </div>
                @endforeach
            </div>
            @hasanyrole('admin|member')
            <footer class="flex flex-col gap-2">
                <x-link.button href="{{ route('categories.index') }}">
                    {{__('New Category')}}
                </x-link.button>
            </footer>
            @endhasanyrole
        </x-card.side>
    @endif
</div>

