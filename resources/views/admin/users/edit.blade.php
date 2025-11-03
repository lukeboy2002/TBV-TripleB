<x-app-layout title="Users">
    <x-heading.main>Users</x-heading.main>
    <div class="flex flex-col gap-6">
        <livewire:users.user-edit :user="$user" />
    </div>
</x-app-layout>