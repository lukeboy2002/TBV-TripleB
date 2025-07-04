<x-app-layout title="Image">

    <x-tbv-heading_h3>{{ $image->name }}</x-tbv-heading_h3>
    <div class="container mx-auto flex justify-between m-2 p-2 bg-background/80 shadow-md rounded-lg">
        <div class="m-2 p-2">
            <img src="{{ $image->getUrl() }}" alt="$image->name">
        </div>
    </div>
    <x-slot name="side">
        dksahfdjk
    </x-slot>
</x-app-layout>