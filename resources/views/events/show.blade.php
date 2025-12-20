<x-app-layout title="Event">

    <x-heading.main>{{ $event->title }}</x-heading.main>

    <x-card.blog>
        <x-slot name="header">

            <img class="rounded-t-lg h-[30rem] min-h-full w-full object-cover"
                 src="{{ asset('storage/'. $event->image_path) }}"
                 alt="{{ $event->title }}"/>

        </x-slot>
        <div class="flex justify-between items-center mb-4 bg-background-hover rounded-lg px-4 py-2">
            <div class="flex items-center gap-2">
                <div>
                    <x-lucide-calendar-days class="w-10 h-10 text-primary-muted"/>
                </div>
                <div>
                    <div class="text-lg text-secondary font-black">Date</div>
                    <date class="text-sm text-primary-muted">{{ $event->date->format('d M Y - h:i') }}</date>
                </div>
            </div>
            @if($event->end_date)
                <div class="flex items-center gap-2">
                    <div>
                        <x-lucide-calendar-days class="w-10 h-10 text-primary-muted"/>
                    </div>

                    <div>
                        <div class="text-lg text-secondary font-black">Date</div>
                        <date class="text-sm text-primary-muted">{{ $event->end_date->format('d M Y - h:i') }}</date>
                    </div>

                </div>
            @endif
            <div class="flex items-center gap-2">
                <div>
                    <x-lucide-user class="w-10 h-10 text-primary-muted"/>
                </div>
                <div>
                    <div class="text-lg text-secondary font-black">Creator</div>
                    <date class="text-sm text-primary-muted">{{ $event->user->username }}</date>
                </div>
            </div>

        </div>
        <div class="prose prose-orange dark:prose-invert text-primary px-4 max-w-7xl">
            {!! $event->body !!}
        </div>
    </x-card.blog>
    <x-slot name="side">
        <div class="flex flex-col gap-6">
            <livewire:events.attendance :event="$event" wire:key="event-attendance-{{ $event->id }}"/>
            <livewire:events.attendance-list :event="$event" wire:key="event-attendance-list-{{ $event->id }}"/>
        </div>

    </x-slot>
</x-app-layout>