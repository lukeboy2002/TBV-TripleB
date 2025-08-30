<x-app-layout title="Blog">
    <x-slot name="header">
        <x-heading.main>BLOG</x-heading.main>
    </x-slot>
    @can('create:post')
        <div class="flex justify-end space-x-2 mb-4">
            <x-link.button href="{{ route('posts.create') }}">Nieuwe Post</x-link.button>
        </div>
    @endcan
    <livewire:posts.posts-index/>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            <x-search/>
            <x-category-list/>
        </div>
    </x-slot>
</x-app-layout>