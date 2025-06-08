<x-app-layout title="Invitations">
    <x-tbv-heading_h3>Invitations</x-tbv-heading_h3>

    <div class="bg-background/80 rounded-lg p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                 role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.invitations.create') }}"
               class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-secondary/70 focus:bg-secondary/70 active:bg-secondary/70 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                Invite New User
            </a>
        </div>

        <livewire:invitations-list />
    </div>

    <x-slot name="side">
        <div class="flex flex-col gap-12">
            <x-tbv-search/>
            <x-tbv-category/>
        </div>
    </x-slot>
</x-app-layout>
