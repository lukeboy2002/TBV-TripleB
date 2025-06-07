<!-- resources/views/games/index.blade.php -->
<x-app-layout title="Games">
    <x-tbv-heading_h3>Game Management</x-tbv-heading_h3>

    <div class="grid grid-cols-1 gap-6 bg-background/80 rounded-lg">
        <livewire:game-manager/>
        <livewire:player-stats/>
    </div>
</x-app-layout>