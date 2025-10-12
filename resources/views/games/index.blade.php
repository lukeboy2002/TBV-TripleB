<x-app-layout title="Games">

    <x-heading.main>{{ __('Games') }}</x-heading.main>
    @can('create:game')
        <div class="flex justify-end space-x-2 pb-4">
            <x-link.button href="{{ route('game.create') }}">{{ __('New Game') }}</x-link.button>
        </div>
    @endcan
    <livewire:games.games-index/>
    <livewire:games.player-stats/>
    <x-slot name="side">
        <div class="flex flex-col gap-6">
            <livewire:games.cup-winner/>
            <livewire:games.latest-game/>
        </div>
    </x-slot>
</x-app-layout>