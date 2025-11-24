<div class="max-w-7xl mx-auto p-6 relative">
    <x-heading.main>{{ __('Photo Albums') }}</x-heading.main>

    @php
        // Rotation and tilt variety for a playful look
        $rotations = ['-rotate-2', 'rotate-1', 'rotate-3', '-rotate-1', 'rotate-2', '-rotate-3', 'rotate-1', '-rotate-2', 'rotate-2'];
        $skews = ['skew-y-0','skew-y-1','-skew-y-1','skew-y-2','-skew-y-2'];
        // Use a seed from the Livewire component so layout changes per reload/pagination
        $seed = $this->layoutSeed ?? random_int(PHP_INT_MIN, PHP_INT_MAX);
    @endphp

    @if($this->albums->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($this->albums as $album)
                @php
                    $cover = $album->getFirstMediaUrl('albums', 'thumbnail') ?: ($album->image_path ? asset('storage/'.$album->image_path) : null);
                    // Derive per-card pseudo-randomness from a stable hash based on the seed and album id
                    $h = crc32($seed . '-' . ($album->id ?? $loop->iteration) . '-' . $loop->iteration);
                    $tilt = $rotations[$h % count($rotations)] . ' ' . $skews[($h >> 3) % count($skews)];
                    // Vary some cards to span more space and height for playful layout
                    $span = ((($h >> 5) % 5) === 0) ? 'md:col-span-2' : '';
                    $height = ((($h >> 7) % 2) === 0) ? 'h-72' : 'h-56';
                @endphp
                <div class="relative group {{ $span }}" wire:key="album-{{ $album->id }}">
                    <div class="relative {{ $height }} rounded-2xl overflow-hidden shadow-md transition-transform duration-300 ease-out group-hover:scale-[1.02]">
                        @if($cover)
                            <div class="absolute inset-0 origin-center {{ $tilt }} transition-transform duration-500 group-hover:rotate-0">
                                <img src="{{ $cover }}" alt="{{ $album->title }}"
                                     class="w-full h-full object-cover" loading="lazy">
                            </div>
                        @else
                            <div class="absolute inset-0 origin-center {{ $tilt }} transition-transform duration-500 group-hover:rotate-0 bg-gradient-to-br from-primary/20 to-secondary/30 flex items-center justify-center">
                                <svg class="w-12 h-12 text-primary/60" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M3 5a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm3 10l3.5-4.5 2.5 3 3.5-4.5L21 15H6z"/>
                                </svg>
                            </div>
                        @endif
                        <!-- subtle vignette and gradient for title readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        <!-- Album title overlay -->
                        <div class="absolute top-0 left-0 p-4 flex items-end justify-between">
                            <h3 class="text-secondary text-lg md:text-xl font-semibold drop-shadow">
                                {{ $album->title }}
                            </h3>
                        </div>
                        <div class="absolute bottom-0 right-0 p-4 flex items-end justify-between">
                            @if($album->user)
                                <span class="text-primary-muted text-xs">{{ __('by') }} {{ $album->user->username }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $this->albums->links() }}
        </div>
    @else
        <x-card.default class="mt-6">
            <div class="p-8 text-center text-primary-muted">
                {{ __('No albums available yet.') }}
            </div>
        </x-card.default>
    @endif
</div>