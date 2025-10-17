<x-app-layout title="Blog">
    <x-heading.main>{{ __('Our Blog') }}</x-heading.main>
    <livewire:posts.posts-index/>

    <x-slot name="side">
        <div class="flex flex-col gap-6">
            <livewire:category.category-list/>
        </div>
    </x-slot>
</x-app-layout>