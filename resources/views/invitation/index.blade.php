<x-admin-layout title="UserManagement">
    <x-heading.heading1>Invitation management</x-heading.heading1>
    <livewire:admin.invitation-index/>

    @if(auth()->user()->can('create:user'))
        <div class="mt-6">
            <x-heading.heading2>Invite User</x-heading.heading2>
            <livewire:admin.invitation-create/>
        </div>
    @endif
</x-admin-layout>