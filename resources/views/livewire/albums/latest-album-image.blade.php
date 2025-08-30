<x-card.side>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            Laatste foto
        </div>
    </x-slot>
    @if(!$latestMedia || !$album)
        <div class="text-primary-muted p-2">Geen foto's</div>
    @else
        <a href="{{ route('albums.show', $album->slug) }}" class="block">
            <img
                    src="{{ $latestMedia->hasGeneratedConversion('thumbnail') ? $latestMedia->getUrl('thumbnail') : $latestMedia->getUrl() }}"
                    alt="{{ $album->name }}"
                    class="w-full rounded-md object-cover"
            />
        </a>
    @endif
</x-card.side>
