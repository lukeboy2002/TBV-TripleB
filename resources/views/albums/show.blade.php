<x-app-layout title="Show Album">
    <x-heading.main>{{ $album->name }}</x-heading.main>
    <x-card.default>
        <div x-data="{ open:false, src:'', alt:'' }">
            <div class="relative w-full">
                <img src="{{ asset($album->image )}}" class="block w-full h-96 object-center object-cover"
                     alt="{{ $album->name }}"/>
            </div>

            <div class="pt-6 grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4">
                @foreach ($photos as $photo)
                    <div class="p-2">
                        <a class="block h-56 overflow-hidden"
                           data-full="{{ $photo->getUrl() }}"
                           data-alt="{{ $photo->name ?? $album->name }}"
                           @click.prevent="open = true; src = $event.currentTarget.dataset.full; alt = $event.currentTarget.dataset.alt">
                            <img alt="{{ $photo->name ?? 'gallery' }}"
                                 class="object-cover object-center w-full h-full block rounded-lg"
                                 src="{{ $photo->getUrl('thumbnail') }}">
                        </a>
                    </div>
                @endforeach
            </div>

            @can('update', $album)
                <div class="mt-4 flex justify-end items-center gap-1">
                    <x-link.icon href="{{ route('album.edit', $album->slug) }}" icon="image-plus" class="text-edit"/>
                    <span class="text-xs text-primary">add images</span>
                </div>
            @endcan

            <!-- Modal -->
            <div x-show="open" x-transition
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-background/70"
                 @keydown.window.escape="open=false">
                <div class="relative max-w-5xl w-full" @click.away="open=false">
                    <button type="button"
                            class="absolute -top-3 -right-3 bg-secondary hover:bg-secondary/50 text-primary rounded-full w-10 h-10 shadow flex items-center justify-center"
                            @click="open=false" aria-label="Close">
                        <x-lucide-x class="w-5 h-5"/>
                    </button>
                    <img :src="src" :alt="alt"
                         class="w-full max-h-[80vh] py-6 object-contain rounded-lg  bg-background"/>
                </div>
            </div>
        </div>
    </x-card.default>
</x-app-layout>