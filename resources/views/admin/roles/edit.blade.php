<x-admin-layout title="Roles">
    <x-heading.main>{{ __('Roles') }}</x-heading.main>
    <div class="flex flex-col gap-6">
        <livewire:roles.role-edit :role="$role"/>
    </div>
</x-admin-layout>