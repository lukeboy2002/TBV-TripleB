<div>
    <div class="px-2 rounded-t-lg bg-background">
        <x-tbv-heading_h5>Categories</x-tbv-heading_h5>
    </div>
    <div class="bg-background-accent">
        <ul>
            @foreach ($categories as $category)
                <li class="text-lg font-extrabold text-primary py-2 {{ !$loop->last ? 'border-b border-border/30' : '' }}">
                    <a wire:navigate href="{{ route('post.index', ['category' => $category->slug]) }}"
                       class="p-2">{{ $category->name }} ({{ $category->posts_count }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>