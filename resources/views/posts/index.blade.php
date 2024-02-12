<x-app-layout>
    <livewire:post-list/>

    <x-slot name="side">
        @include('posts.partials.search-box')

        @include('posts.partials.categories-box')

    </x-slot>
</x-app-layout>
