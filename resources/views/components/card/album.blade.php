<x-card.blog>
    <x-slot name="header">
        <a href="{{ route('albums.show', $album->slug) }}" class="block overflow-hidden">
            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                 src="{{ asset('storage/'. $album->image) }}"
                 alt="{{ $album->name }}"/>
            <span class="absolute flex justify-center items-center bottom-2 right-2 p-2 h-8 w-8 rounded-full bg-background text-primary text-sm font-bold">
                {{ $album->images_count }}
            </span>
        </a>
    </x-slot>
    <x-heading.sub>
        <a href="{{ route('albums.show', $album->slug) }}">
                        <span class="block md:hidden">
                {{ $album->shortName()['large'] }}
            </span>

            <span class="hidden md:block lg:hidden">
                {{ $album->shortName()['mid'] }}
            </span>

            <span class="hidden md:hidden lg:block">
                {{ $album->shortName()['small'] }}
            </span>
        </a>
    </x-heading.sub>
    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <x-link.button
                    href="{{ route('albums.show', $album->slug) }}">
                bekijk album
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