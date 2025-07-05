<div>
    <div class="flex items-center justify-between mb-4">
        <x-tbv-heading_h5>{{ $currentMonth->format('F Y') }}</x-tbv-heading_h5>
        <div class="flex space-x-2">
            <button wire:click="previousMonth"
                    class="p-2 border border-transparent rounded-full hover:bg-background-accent hover:text-secondary hover:border-border">
                <x-lucide-chevron-left class="h-5 w-5"/>
            </button>
            <button wire:click="nextMonth"
                    class="p-2 border border-transparent rounded-full hover:bg-background-accent hover:text-secondary hover:border-border">
                <x-lucide-chevron-right class="h-5 w-5"/>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-7 gap-px bg-secondary border border-border rounded-lg overflow-hidden">
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Mon</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Tue</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Wed</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Thu</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Fri</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Sat</div>
        <div class="bg-background-accent text-center py-2 font-semibold text-primary">Sun</div>

        @foreach($calendar as $day)
            <div class="bg-background-accent min-h-[100px] p-1 {{ $day['isCurrentMonth'] ? '' : 'bg-white dark:bg-black' }}">
                <div class="text-right {{ $day['isCurrentMonth'] ? 'text-primary' : 'text-primary-muted' }} text-sm mb-1">
                    {{ $day['date']->format('j') }}
                </div>

                @if(count($day['events']) > 0)
                    <div class="space-y-1">
                        @foreach($day['events'] as $event)
                            <a href="{{ route('agenda.show', $event) }}"
                               class="block text-xs p-1 rounded bg-secondary text-primary truncate hover:bg-secondary/50">
                                {{ $event->date->format('H:i') }} - {{ $event->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>