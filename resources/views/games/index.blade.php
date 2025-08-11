<x-app-layout title="Blog">
    <x-slot name="header">
        <x-heading.main>Game Management</x-heading.main>
    </x-slot>
    <livewire:games.games-manager/>
    <livewire:games.player-stats/>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            <livewire:games.cup-winner/>
        </div>
    </x-slot>
</x-app-layout>