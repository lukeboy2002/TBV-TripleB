<x-card.side>
    <x-slot name="header">
        {{ __('Latest Photo') }}
    </x-slot>

    <div>
        @if($photo)
            @php($album = $photo->model)

            <div class="rounded-lg shadow-md bg-background-hover/20">
                <div class="relative">
                    <a href="{{ route('albums.show', $album) }}">
                        <img src="{{ $photo->getUrl() }}"
                             alt="{{ $album?->title }}"
                             class="w-full h-56 object-cover rounded-lg shadow">

                        <div class="absolute top-0 left-0 w-full bg-background-hover/50 text-secondary font-black px-3 py-1 rounded-t">
                            {{ ucfirst($album?->title) }}
                        </div>

                        @if($album?->user)
                            <div class="absolute bottom-0 right-0 flex gap-2 items-center p-1">
                                <div class="text-primary-muted text-xs">{{ __('By') }} {{ ucfirst($album->user->username) }}</div>
                            </div>
                        @endif
                    </a>
                </div>
            </div>
        @else
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-image-off class="w-14 h-14 text-secondary"/>
                <p class="text-xl">{{ __('No photos available yet.') }}</p>
            </div>
        @endif
    </div>
</x-card.side>
