<x-app-layout title="Events">
    <x-heading.main>{{ __('Our Events') }}</x-heading.main>
    <livewire:events.event-index/>

    <x-slot name="side">
        <livewire:events.event-calendar/>
    </x-slot>
</x-app-layout>
