<x-card.default>
    <div>
        <div class="relative w-full pb-4">
            <img src="{{ asset('storage/' .$album->image_path)}}" class="block w-full h-96 object-center object-cover"
                 alt="{{ $album->title }}"/>
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="w-full text-center bg-background-hover/50 px-3 py-1 text-secondary font-secondary text-4xl font-bold">{{ $album->title }}</h1>
            </div>
            <div class="absolute bottom-5 right-5 flex gap-2 items-center p-1">

                <div class="text-primary-muted text-xs">{{ __('By') }} {{ ucfirst($album->user->username) }}</div>
                @can('update', $album)
                    <x-link.icon icon="image-plus" href="{{ route('album.edit', $album->slug) }}"
                                 class="text-edit"/>
                @endcan
                @can('delete', $album)
                    <div class="flex items-center gap-2">
                        <x-button.icon wire:click="confirmDeletion({{ $album->id }})" icon="trash"
                                       class="text-error"/>
                    </div>
                @endcan
            </div>

        </div>
        <div class="w-full">
            <div class="pb-4 prose prose-orange dark:prose-invert text-primary w-full">
                {!! $album->body !!}
            </div>
        </div>

        <x-heading.sub>{{ __('Photos') }}</x-heading.sub>
        @if ($photos->total())
            @php
                // Playful layout controls inspired by ORGalbum_index
                $rotations = ['-rotate-2', 'rotate-1', 'rotate-3', '-rotate-1', 'rotate-2', '-rotate-3', 'rotate-1', '-rotate-2', 'rotate-2'];
                $skews = ['skew-y-0','skew-y-1','-skew-y-1','skew-y-2','-skew-y-2'];
                // Use a seed so each reload can vary slightly; fall back to a random if not provided
                $seed = $this->layoutSeed ?? random_int(PHP_INT_MIN, PHP_INT_MAX);
            @endphp
            <div class="pt-6 grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-5">
                @foreach ($photos as $photo)
                    @php
                        // Create a stable-ish hash per photo based on seed and photo id
                        $h = crc32($seed . '-' . ($photo->id ?? $loop->iteration) . '-' . $loop->iteration);
                        $tilt = $rotations[$h % count($rotations)] . ' ' . $skews[($h >> 3) % count($skews)];
                        // Occasionally span two columns on md+ for variety
                        $span = ((($h >> 5) % 6) === 0) ? 'md:col-span-2' : '';
                        // Vary height
                        $height = ((($h >> 7) % 2) === 0) ? 'h-72' : 'h-56';
                    @endphp
                    <div class="p-1 md:p-2 {{ $span }}" wire:key="photo-{{ $photo->id }}">
                        <a href="#" wire:click.prevent="openImageById({{ $photo->id }})"
                           class="block relative {{ $height }} rounded-2xl overflow-hidden shadow-md transition-transform duration-300 ease-out group hover:scale-[1.02]">
                            <div class="absolute inset-0 origin-center {{ $tilt }} transition-transform duration-500 group-hover:rotate-0">
                                <img alt="{{ $photo->name ?? 'gallery' }}"
                                     class="w-full h-full object-cover"
                                     src="{{ $photo->getUrl('thumbnail') }}">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent pointer-events-none"></div>
                        </a>
                    </div>
                @endforeach
            </div>
            @can('upload:image')
                <div class="flex justify-end">
                    <x-link.default href="{{ route('album.edit', $album->slug) }}" icon="image-plus">
                        add image
                    </x-link.default>
                </div>
            @endcan
            <div class="mt-8 flex justify-center">
                {{ $photos->links() }}
            </div>
        @else
            <div class="pt-4">
                <x-card.default>
                    <div class="text-primary-muted flex flex-col items-center gap-2">
                        <x-lucide-image-off class="w-14 h-14 text-secondary"/>
                        <p class="text-xl">
                            {{ __('No Images available yet.') }}</p>
                    </div>
                    @can('upload:image')
                        <div class="flex justify-end items-center gap-2">
                            <x-link.default href="{{ route('album.edit', $album->slug) }}" icon="image-plus">
                                add image
                            </x-link.default>
                        </div>
                    @endcan
                </x-card.default>
            </div>
        @endif

        @if($showModal)
            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                 role="dialog"
                 aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                         wire:click="toggleModal"></div>

                    <!-- Main modal -->
                    <div class="flex justify-between items-center h-screen max-w-3xl mx-auto">
                        <div class="bg-background border border-secondary/30 relative rounded-lg shadow-sm w-full">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-secondary/30">
                                <h3 class="text-xl font-semibold text-secondary font-secondary">
                                    {{ __('Image') }}
                                </h3>
                                <x-button.icon type="button"
                                               class="text-secondary"
                                               icon="x"
                                               wire:click="toggleModal"
                                               data-modal-hide="album-image-modal"/>
                                <span class="sr-only">Close modal</span>
                            </div>
                            <!-- Modal body -->
                            <div class="p-0 md:p-0">
                                @if($modalImageUrl)
                                    <img src="{{ $modalImageUrl }}" alt="{{ $modalImageAlt ?? 'image' }}"
                                         class="block w-full max-h-[80vh] object-contain bg-black/60">
                                @endif
                            </div>
                            <div class="p-4 md:p-5 flex justify-end gap-2 border-t border-secondary/30">
                                <x-button.secondary wire:click="toggleModal" type="button">
                                    {{ __('Close') }}
                                </x-button.secondary>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-card.default>