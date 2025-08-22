<x-app-layout title="Blog">
    <x-slot name="header">
        <x-heading.main>Albums</x-heading.main>
    </x-slot>
    @can('create:event')
        <div class="flex justify-end space-x-2 mb-4">
            <x-link.button href="{{ route('agenda.create') }}">New Event</x-link.button>
        </div>
    @endcan
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
        EVENTS
    </div>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            Latest Event
        </div>
    </x-slot>
</x-app-layout>