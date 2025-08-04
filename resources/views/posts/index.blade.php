<x-app-layout title="Blog">
    <x-slot name="header">

        <x-heading.main>BLOG</x-heading.main>
    </x-slot>
    <livewire:posts.posts-index/>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            @can('create:post')
                <x-link.button href="{{ route('posts.create') }}">New Post</x-link.button>
            @endcan
            <x-search/>
            <x-category-list/>
        </div>
    </x-slot>
</x-app-layout>