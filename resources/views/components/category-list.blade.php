<x-card.side>
    <x-slot name="header">
        Categorie
    </x-slot>
    @foreach ($categories as $category)
        <div class="text-lg font-extrabold text-primary py-2 {{ !$loop->last ? 'border-b border-secondary/30' : '' }}">
            <a wire:navigate href="{{ route('post.index', ['category' => $category->slug]) }}"
               class="p-2 flex items-center gap-2">{{ $category->name }} <span
                        class="text-xs lg:text-lg">({{ $category->posts_count }})</span>
            </a>
        </div>
    @endforeach
</x-card.side>
