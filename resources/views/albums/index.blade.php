<x-app-layout title="Blog">
    <x-slot name="header">
        <x-heading.main>Albums</x-heading.main>
    </x-slot>
    @can('create:album')
        <div class="flex justify-end space-x-2 mb-4">
            <x-link.button href="{{ route('album.create') }}">New Album</x-link.button>
        </div>
    @endcan
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
        @foreach($albums as $album)
            <x-card.album :album="$album"/>
        @endforeach
    </div>
    
    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            <livewire:albums.latest-album-image/>
        </div>
    </x-slot>
</x-app-layout>