<x-card.side>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            Agenda
        </div>
    </x-slot>
    @if(!$agenda)
        <div class="text-primary-muted p-2">Geen aankomende evenementen.</div>
    @else
        <div class="p-4">
            <p class="text-sm font-medium text-secondary truncate">{{ $agenda->name }}</p>
            <p class="flex justify-end items-center text-xs text-primary-muted">{{ $agenda->getFormattedDate() }}</p>

            @if($agenda->description)
                <div class="content text-primary text-sm line-clamp-2 pt-4">
                    {!! $agenda->description !!}
                </div>
            @endif
        </div>
    @endif
</x-card.side>