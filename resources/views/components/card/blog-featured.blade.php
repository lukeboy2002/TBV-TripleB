<x-card.blog>
    <x-slot name="header">
        <a href="{{ route('post.show', $post->slug) }}" class="block overflow-hidden">
            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                 src="{{ asset('storage/'. $post->image) }}"
                 alt="{{ $post->title }}"/>
            <livewire:posts.stats :post="$post"/>

        </a>
        <div class="absolute top-4 left-0">
            <x-badge.category :color="$post->category->color">
                {{ $post->category->name }}
            </x-badge.category>
        </div>
    </x-slot>
    <x-heading.sub><a href="{{ route('post.show', $post->slug) }}">
            <span class="block md:hidden">
                {{ $post->shortTitle()['large'] }}
            </span>

            <span class="hidden md:block lg:hidden">
                {{ $post->shortTitle()['mid'] }}
            </span>

            <span class="hidden md:hidden lg:block">
                {{ $post->shortTitle()['small'] }}
            </span>
        </a>
    </x-heading.sub>
</x-card.blog>
