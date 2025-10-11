<x-app-layout title="Games">

    <x-heading.main>Game Management</x-heading.main>

    <x-slot name="side">
        <div class="flex flex-col gap-6">
            <livewire:games.cup-winner/>
            <livewire:games.latest-game/>
        </div>
    </x-slot>
</x-app-layout>