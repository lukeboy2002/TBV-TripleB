<x-card.side>
    <x-slot name="header">Menu</x-slot>

    <div class="flex flex-col gap-y-4">
        @role('admin')
        <x-link.navigation href="{{ route('roles.index') }}"
                           :active="request()->routeIs('roles.*')"
                           icon="shield">
            {{ __('Roles') }}
        </x-link.navigation>

        <x-link.navigation href="{{ route('users.index') }}"
                           :active="request()->routeIs('users.*')"
                           icon="user-cog">
            {{ __('Users') }}
        </x-link.navigation>

        @endrole

        <x-link.navigation href="{{ route('categories.index') }}"
                           :active="request()->routeIs('categories.index')"
                           icon="tags">
            {{ __('Categories') }}
        </x-link.navigation>

        {{--        TODO: POSTINDEX per User--}}
        {{--        <x-link.navigation href=""--}}
        {{--                           icon="users">--}}
        {{--            {{ __('Post') }}--}}
        {{--        </x-link.navigation>--}}

        <x-link.navigation href="{{ route('invitations.index') }}"
                           :active="request()->routeIs('invitations.index')"
                           icon="user-plus">
            {{ __('Invite User') }}
        </x-link.navigation>

        <x-link.navigation href="{{ route('game.create') }}"
                           :active="request()->routeIs('game.create')"
                           icon="dices">
            {{ __('Create Game') }}
        </x-link.navigation>
    </
    >
</x-card.side>

