<x-admin-layout title="Permissions">
    <x-heading.heading1>Permissions</x-heading.heading1>
    <livewire:admin.permission-index/>

    @if(auth()->user()->can('create:permission'))
        <div class="mt-6">
            <x-heading.heading2>Add Permission</x-heading.heading2>
            <livewire:admin.permission-create/>
        </div>
    @endif
</x-admin-layout>