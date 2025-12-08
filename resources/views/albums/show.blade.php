<x-app-layout title="Albums">
    <x-heading.main>{{ __('Albums') }}</x-heading.main>
    <livewire:albums.album-show :album="$album"/>

    <x-slot name="side">
        <div class="flex flex-col gap-6">
            <livewire:albums.latest-album/>
            <livewire:albums.latest-photo/>
        </div>
    </x-slot>
</x-app-layout>