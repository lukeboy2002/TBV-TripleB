<x-app-layout title="Posts">
    <x-tbv-heading_h3>Blog</x-tbv-heading_h3>

    <livewire:posts-index/>

    <x-slot name="side">
        <div class="flex flex-col gap-12">
            <x-tbv-search/>
            <x-tbv-category/>
        </div>
    </x-slot>
</x-app-layout>