<x-app-layout title="Users">
    <x-heading.main>{{ __('Users') }}</x-heading.main>
    <div class="flex flex-col gap-6">
        <livewire:users.users-index/>
    </div>
</x-app-layout>