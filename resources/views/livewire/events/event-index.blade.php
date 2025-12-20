<div class="mb-6">
    @can('create:event')
        <div class="flex justify-end space-x-2 pb-4">
            <x-link.button href="{{ route('events.create') }}">{{ __('New Event') }}</x-link.button>
        </div>
    @endcan

    @if ($this->events->count() >1 )
        <div class="grid grid-cols-1 gap-y-6">
            @foreach($this->events as $event )

                <x-card.event>
                    <x-slot name="image">

                        <a href="{{ route('events.show', $event->slug) }}" class="block overflow-hidden">
                            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                                 src="{{ asset('storage/'. $event->image_path) }}"
                                 alt="{{ $event->title }}"/>
                        </a>

                        <div class="absolute top-0 left-0 text-2xl text-secondary font-secondary font-black bg-background/60 py-2 px-5">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-3xl font-semibold">
                                    {{ $event->date->format('d') }}
                                </span>
                                <span class="text-xs uppercase tracking-wider">
                                    {{ $event->date->format('M') }}
                                </span>
                            </div>
                        </div>

                    </x-slot>
                    <div class="mr-2">
                        <x-heading.eventtitle :text-wrap="true" :truncate="true">
                            <a href="{{ route('events.show', $event->slug) }}">
                                {{ $event->title }}
                            </a>
                        </x-heading.eventtitle>
                        <div class="text-primary text-sm pt-4 text-wrap truncate">
                            {!! $event->description !!}
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-end items-center pb-2">
                            <div class="flex items-center gap-2">
                                <livewire:events.attending-count :event="$event"
                                                                 wire:key="attending-count-{{ $event->id }}"/>
                                <livewire:actions.event-actions :event="$event"/>
                            </div>

                        </div>
                    </x-slot>
                </x-card.event>
            @endforeach
        </div>
        <div class="pt-4">
            {{ $this->events->onEachSide(1)->links() }}
        </div>
    @else
        <x-card.default>
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-calendar-days class="w-14 h-14 text-secondary"/>
                <p class="text-xl">
                    {{ __('No events found') }}</p>
            </div>
        </x-card.default>
    @endif
</div>
