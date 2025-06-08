<x-app-layout title="Invitations">
    <x-tbv-heading_h3>Invite User</x-tbv-heading_h3>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-background/80 rounded-lg p-4 mb-8">
        <form action="{{ route('admin.invitations.store') }}" method="POST">
            @csrf
            <div>
                <x-tbv-label for="email" value="Email"/>
                <x-tbv-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autocomplete="email"/>
                <x-tbv-input-error for="email" class="mt-2"/>
            </div>
            <div class="flex justify-end pt-6">
                <x-tbv-button>Save</x-tbv-button>
            </div>
        </form>
    </div>

    <x-tbv-heading_h3>Invitations</x-tbv-heading_h3>

    <livewire:invitations-list />

    <x-slot name="side">
        <div class="flex flex-col gap-12">
            <x-tbv-search/>
            <x-tbv-category/>
        </div>
    </x-slot>

</x-app-layout>
