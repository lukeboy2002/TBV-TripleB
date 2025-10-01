<x-card.side>
    <x-slot name="header">Menu</x-slot>

    <div class="flex flex-col gap-4">
        <x-link.navigation href="{{ route('categories.index') }}" :active="request()->routeIs('categories.index')"
                           icon="tags">
            {{ __('Categories') }}
        </x-link.navigation>

        <x-link.navigation href="#" icon="users">
            {{ __('Post') }}
        </x-link.navigation>

        <x-link.navigation href="{{ route('invitations.index') }}" :active="request()->routeIs('invitations.index')"
                           icon="user-plus">
            {{ __('Invite User') }}
        </x-link.navigation>
    </div>
</x-card.side>

