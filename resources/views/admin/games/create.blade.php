<x-admin-layout title="Games">

    <x-heading.main>{{ __('New Game') }}</x-heading.main>
    <livewire:games.games-create/>

    <x-slot:side>
        <livewire:games.cup-winner/>
        <livewire:games.latest-game/>
    </x-slot:side>

</x-admin-layout>
