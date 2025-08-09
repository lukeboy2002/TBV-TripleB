<x-card.blog>
    <x-slot name="header">
        <a href="{{ route('albums.show', $album->slug) }}" class="block overflow-hidden">
            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                 src="{{ Storage::url($album->image) }}"
                 alt="{{ $album->name }}"/>
        </a>
    </x-slot>
    <x-heading.sub>
        <a href="{{ route('albums.show', $album->slug) }}">
            {{ $album->name }}
        </a>
    </x-heading.sub>
    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <x-link.button
                    href="{{ route('albums.show', $album->slug) }}">
                view album
            </x-link.button>
            <div class="flex gap-2 items-center">
                @can('update', $album)
                    <x-link.icon icon="image-plus" href="{{ route('album.edit', $album->slug) }}" class="text-edit"/>
                @endcan
                @can('delete', $album)
                    <x-link.icon icon="image-minus" href="{{ route('album.destroy', $album->slug) }}"
                                 class="text-error"/>
                @endcan
            </div>
        </div>
    </x-slot>
</x-card.blog>