<x-app-layout title="Albums">
    <x-tbv-heading_h3>Our Albums</x-tbv-heading_h3>

    @forelse($albums as $album)
        @if ($loop->first)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                @endif

                <x-tbv-card>
                    <x-slot name="header">
                        <a href="{{ route('albums.show', $album->slug) }}" class="block overflow-hidden">
                            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                                 src="{{ Storage::url($album->image) }}"
                                 alt="{{ $album->name }}"/>
                        </a>
                    </x-slot>
                    <a href="#"
                       class="mb-2 text-xl font-bold tracking-tight text-primary">{{ $album->name }}</a>
                    <div class="flex flex-col gap-4 pt-4">
                        <div class="text-primary text-sm">
                            {{ $album->description }}
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-between items-center">
                            <a class="px-3 py-2 flex items-center gap-2 text-xs font-medium text-center text-primary bg-secondary rounded-lg hover:bg-secondary/60 focus:ring-4 focus:outline-none focus:ring-ring"
                               href="{{ route('albums.show', $album->slug) }}">
                                <x-lucide-scan-eye class="h-4 w-4"/>
                                View album
                            </a>

                            <div class="flex items-center gap-2">
                                @can('update', $album)
                                    <a href="{{ route('admin.albums.edit', $album->slug) }}"
                                       class="inline-flex items-center px-2 py-1 bg-button-secondary border border-transparent rounded-md font-semibold text-xs text-edit uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                        <x-lucide-edit class="h-3 w-3"/>
                                    </a>
                                @endcan
                                <livewire:delete-album :album="$album"/>
                            </div>
                        </div>
                    </x-slot>
                </x-tbv-card>

                @if ($loop->last)
            </div>
        @endif
    @empty
        <div class="mx-auto w-full max-w-7xl py-4 bg-background/80 rounded-lg p-4 flex justify-between items-center">
            <h2 class="text-secondary text-lg font-bold flex items-center gap-2">
                <x-lucide-image-off class="h-5 w-5"/>
                no albums yet
            </h2>
            @can('create', App\Models\Album::class)
                <x-tbv-link-btn href="{{ route('admin.albums.create') }}">
                    Add Album
                </x-tbv-link-btn>
            @endcan
        </div>
    @endforelse

    <x-slot name="side">
        <div class="flex flex-col gap-12">
            <x-category/>
        </div>
    </x-slot>
</x-app-layout>
