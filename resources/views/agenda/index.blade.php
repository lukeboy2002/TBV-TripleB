<x-app-layout title="Events">
    <x-slot name="header">
        <x-heading.main>Events</x-heading.main>
    </x-slot>
    @can('create:event')
        <div class="flex justify-end space-x-2 mb-4">
            <x-link.button href="{{ route('agenda.create') }}">New Event</x-link.button>
        </div>
    @endcan

    <x-card.default>
        <div class="{{ $agendas->count() > 1 ? 'divide-y divide-secondary/30' : '' }}">
            @forelse($agendas as $agenda)
                <div>
                    <a href="{{ route('agenda.show', $agenda) }}" class="block hover:bg-background-hover">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($agenda->image)
                                        <div class="flex-shrink-0 h-12 w-12 mr-3">
                                            <img class="h-12 w-12 rounded-full object-cover"
                                                 src="{{ Storage::url($agenda->image) }}"
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
                                @hasanyrole('admin|member')
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $agenda->attendances->where('status', 'attending')->count() }} attending
                                    </p>
                                </div>
                                @endhasanyrole
                            </div>
                            @if($agenda->description)
                                <div class="content text-primary line-clamp-4 pt-4">
                                    {!! $agenda->description !!}
                                </div>
                            @endif
                        </div>
                        @hasanyrole('admin|member')
                    </a>
                    @endhasanyrole
                </div>
            @empty
                <div class="px-4 py-4 text-secondary font-bold text-xl">
                    No events found.
                </div>
            @endforelse
        </div>
    </x-card.default>
    <div class="p-4">
        {{ $agendas->links() }}
    </div>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            Latest Event
        </div>
    </x-slot>
</x-app-layout>