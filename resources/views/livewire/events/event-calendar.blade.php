<x-card.side>
    <x-slot name="header">
        {{ __('Calendar')}}
    </x-slot>
    <div class="text-center">
        {{-- Navigatie --}}
        <div class="flex items-center text-gray-900 dark:text-white">
            <button type="button"
                    wire:click="previousMonth"
                    class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-white">
                <span class="sr-only">{{ __('Previous month') }}</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                          clip-rule="evenodd" fill-rule="evenodd"/>
                </svg>
            </button>
            <div class="flex-auto text-sm font-semibold">{{ $currentMonthName }}</div>
            <button type="button"
                    wire:click="nextMonth"
                    class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-white">
                <span class="sr-only">{{ __('Next month') }}</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                          clip-rule="evenodd" fill-rule="evenodd"/>
                </svg>
            </button>
        </div>

        {{-- Dagen van de week --}}
        <div class="mt-6 grid grid-cols-7 text-xs/6 text-gray-500 dark:text-gray-400">
            <div>M</div>
            <div>T</div>
            <div>W</div>
            <div>T</div>
            <div>F</div>
            <div>S</div>
            <div>S</div>
        </div>

        {{-- Kalender Raster --}}
        <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow-sm ring-1 ring-gray-200 dark:bg-white/15 dark:shadow-none dark:ring-white/15">
            @foreach($days as $day)
                @php
                    // We definiëren de classes hier één keer om dubbele code te voorkomen
                    $classes = \Illuminate\Support\Arr::toCssClasses([
                        'py-1.5 hover:bg-gray-100 focus:z-10 dark:hover:bg-gray-900/25 block w-full',
                        'bg-white text-gray-900 dark:bg-gray-900/90 dark:text-white' => $day['is_current_month'],
                        'bg-gray-50 text-gray-400 dark:bg-gray-900/75 dark:text-gray-500' => !$day['is_current_month'],
                        'font-semibold text-indigo-600 dark:text-indigo-400' => $day['is_today'] && !$day['event'],
                        'font-semibold text-white' => $day['event'],
                        'rounded-tl-lg' => $loop->first,
                        'rounded-br-lg' => $loop->last,
                        'rounded-bl-lg' => $loop->iteration == count($days) - 6,
                        'rounded-tr-lg' => $loop->iteration == 7,
                    ]);
                @endphp

                @if($day['event'])
                    {{-- Als er een event is: Link naar de show pagina --}}
                    <a href="{{ route('events.show', $day['event']) }}" class="{{ $classes }}">
                        <time datetime="{{ $day['date']->format('Y-m-d') }}"
                                @class([
                                    'mx-auto flex size-7 items-center justify-center rounded-full',
                                    'bg-indigo-600 dark:bg-indigo-500 text-white shadow-sm' => $day['event'],
                                ])
                        >
                            {{ $day['day_number'] }}
                        </time>
                    </a>
                @else
                    {{-- Geen event: Gewone knop (niet klikbaar voor navigatie) --}}
                    <button type="button" class="{{ $classes }}">
                        <time datetime="{{ $day['date']->format('Y-m-d') }}"
                                @class([
                                    'mx-auto flex size-7 items-center justify-center rounded-full',
                                    'bg-gray-900 text-white dark:bg-white dark:text-gray-900' => $day['is_today']
                                ])
                        >
                            {{ $day['day_number'] }}
                        </time>
                    </button>
                @endif
            @endforeach
        </div>
    </div>
</x-card.side>