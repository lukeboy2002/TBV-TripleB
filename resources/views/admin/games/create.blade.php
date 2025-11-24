<x-admin-layout title="Games">

    <x-heading.main>{{ __('New Game') }}</x-heading.main>
    <livewire:games.games-create/>

    <x-slot:side>
        <div class="flex flex-col gap-4">
            <livewire:games.cup-winner/>
            <livewire:games.latest-game/>
        </div>
    </x-slot:side>

</x-admin-layout>
