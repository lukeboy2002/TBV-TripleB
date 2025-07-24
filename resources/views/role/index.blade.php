<x-admin-layout title="Roles">
    <x-heading.heading1>Roles</x-heading.heading1>
    <livewire:admin.role-index/>


    @if(auth()->user()->can('create:role'))
        <div class="mt-6">
            <x-heading.heading2>Add Role</x-heading.heading2>
            <livewire:admin.role-create/>
        </div>
    @endif
</x-admin-layout>