<div>
    <x-tbv-heading_h3>Events Calendar</x-tbv-heading_h3>
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 bg-background/80 rounded-lg">
        <div class="flex justify-end items-center gap-2 mb-6">
            <x-tbv-input type="text" wire:model.live="search" placeholder="Search events..."
                         class="px-4 py-2 border rounded-md"/>
            @can('create', App\Models\Agenda::class)
                <x-tbv-link-btn href="{{ route('agenda.create') }}">
                    Create Event
                </x-tbv-link-btn>
            @endcan

        </div>

        <div class="mb-8">
            <livewire:agenda-calendar/>
        </div>

        <div class="bg-background-accent shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-divide/30">
                @forelse($agendas as $agenda)
                    <li>
                        <a href="{{ route('agenda.show', $agenda) }}" class="block hover:bg-background-hover">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        @if($agenda->image_path)
                                            <div class="flex-shrink-0 h-12 w-12 mr-3">
                                                <img class="h-12 w-12 rounded-full object-cover"
                                                     src="{{ Storage::url($agenda->image_path) }}"
                                                     alt="{{ $agenda->name }}">
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium text-secondary truncate">{{ $agenda->name }}</p>
                                            <p class="flex items-center text-sm text-primary-muted">
                                                <span>{{ $agenda->date->format('F j, Y g:i A') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $agenda->attendances->where('status', 'attending')->count() }} attending
                                        </p>
                                    </div>
                                </div>
                                @if($agenda->description)
                                    <div class="mt-2 text-sm text-shadow-primary line-clamp-2">
                                        {{ $agenda->description }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    </li>
                @empty
                    <div class="flex justify-between items-center px-4 py-4">
                        <div class="text-secondary text-xl">
                            No events found.
                        </div>
                        @can('create', App\Models\Agenda::class)
                            <x-tbv-link-btn href="{{ route('agenda.create') }}">
                                Create Event
                            </x-tbv-link-btn>
                        @endcan
                    </div>
                @endforelse
            </ul>

            <div class="px-4">
                {{ $agendas->links() }}
            </div>
        </div>
    </div>
</div>